<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Http\Requests\StoreReservationRequest;
use App\Models\Price;
use App\Models\Representation;
use App\Models\RepresentationReservation;
use Illuminate\Http\Request;
use Stripe\Stripe;
use App\Models\Seat;
use App\Enums\StatusEnum;
use App\Models\RepresentationSeat;
use Stripe\Checkout\Session as CheckoutSession;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    // @todo déplacer la fonction la logique de payement dans le controller de paiement
    /**
     * Fonction pour calculer le total du panier de réservation en cours
     */
    private function calculateCartTotal()
    {

        $reservations = Reservation::where('user_id', auth()->id())
            ->where('status', StatusEnum::PENDING)
            ->get();

        $total = $reservations->map(function ($reservation) {
            return $reservation->total();
        })->sum();

        return $total;
    }
    /**
     * Fonction qui gère le processus de réservation et paiement via stripe checkout
     * @param Request $request
     * @param StoreReservationRequest $reservationRequest
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function checkout(Request $request, StoreReservationRequest $reservationRequest)
    {
        try {
            $action = $request->input('action');
            $selectedSeats = $request->input('selected_seats');

            $reservationRequest->validated();

            Stripe::setApiKey(env('STRIPE_SECRET'));

            $reservation = new Reservation([
                'user_id' => auth()->id(),
                'booking_date' => now(),
                'status' => 'pending',
                'stripe_invoice_id' => 'test',
            ]);

            $reservation->save();
            $reservationId = $reservation->id;
            $representationId = $request->representation_id;
            $representation = Representation::findOrFail($representationId);
            $currentPrices = Price::where('end_date', '=', null)->get();

            Log::info('Current prices:', $currentPrices->toArray());

            $line_items = [];
            foreach ($request->get('places') as $type => $quantity) {
                Log::info("Processing place type: $type, quantity: $quantity");

                if ($quantity > 0) {
                    $price = $currentPrices->firstWhere('type', $type);
                    if ($price) {
                        Log::info("Found price for type $type:", $price->toArray());

                        $scheduleDate = \Carbon\Carbon::parse($representation->schedule);

                        // verifier les names des sièges sélectionnés
                        $seats = Seat::all();
                        Log::info('All seats:', $seats->toArray());
                        Log::info('Selected seats:', $selectedSeats);

                        // Récupérer les sièges sélectionnés par leurs numéros
                        foreach ($selectedSeats as $seatNumber) {
                            $seatNumberWithPrefix = 'S' . $seatNumber; // Ajouter le préfixe 'S' pour correspondre au format des sièges
                            Log::info("Processing seat number: $seatNumber");

                            $seat = Seat::where('seat_number', $seatNumberWithPrefix)->first();

                            if ($seat) {
                                Log::info("Found seat:", $seat->toArray());

                                $representationSeat = RepresentationSeat::where('representation_id', $representationId)
                                    ->where('seat_id', $seat->id)
                                    ->first();

                                if ($representationSeat) {
                                    Log::info("Found representation seat:", $representationSeat->toArray());

                                    if ($representationSeat->status == 'available') {
                                        RepresentationReservation::create([
                                            'representation_seat_id' => $representationSeat->id,
                                            'reservation_id' => $reservationId,
                                            'price_id' => $price->id,
                                            'quantity' => 1,
                                        ]);

                                        // Mettre à jour le statut du siège
                                        $representationSeat->status = 'reserved';
                                        $representationSeat->save();

                                        $description = 'Réservation pour ' . $representation->show->title . ' le ' . $scheduleDate->format('d/m/Y H:i') . ' à ' . $representation->location->designation;
                                        $line_items[] = [
                                            'price_data' => [
                                                'currency' => 'eur',
                                                'unit_amount' => $price->price * 100,
                                                'product_data' => [
                                                    'name' => "{$quantity}x {$type} - {$representation->show->title}",
                                                    'description' => $description,
                                                ],
                                            ],
                                            'quantity' => 1,
                                        ];

                                        Log::info('Added line item:', end($line_items));
                                    } else {
                                        Log::info("Representation seat not available:", $representationSeat->toArray());
                                    }
                                } else {
                                    Log::info("Representation seat not found for seat:", $seat->toArray());
                                }
                            } else {
                                Log::info("Seat not found for seat number: $seatNumber");
                            }
                        }
                    } else {
                        Log::info("Price not found for type: $type");
                    }
                } else {
                    Log::info("Quantity is zero or less for type: $type");
                }
            }

            Log::info('Final line items for Stripe Checkout:', $line_items);

            if (empty($line_items)) {
                return back()->with('error', 'Aucun article sélectionné pour le paiement.');
            }

            if ($action === 'addToCart') {
                return redirect()->route('reservation.cart')->with('success', 'Réservation ajoutée au panier');
            }

            // Création de la session de paiement Stripe Checkout
            $checkout_session = CheckoutSession::create([
                'payment_method_types' => ['card'],
                'line_items' => $line_items,
                'mode' => 'payment',
                'success_url' => route('reservation.confirmation', ['id' => $reservation->id]),
                'cancel_url' => route('reservation.cancel', ['id' => $reservation->id]),
                'invoice_creation' => [
                    'enabled' => true,
                ],
            ]);

            // Stocker l'ID de la facture Stripe et mettre à jour la réservation
            $reservation->stripe_invoice_id = $checkout_session->id;
            $reservation->save();

            session(['checkout_session_id' => $checkout_session->id]);

            return redirect($checkout_session->url);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Une erreur est survenue lors de la création de la réservation.');
        }
    }


    /**
     * Fonction qui gère la confirmation de la réservation
     * @param string $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     * @throws \Stripe\Exception\ApiErrorException
     * @throws \Throwable
     * @todo Gérer les erreurs de paiement
     * @todo Gérer les erreurs de réservation
     */

    public function confirmation(string $id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            Log::warning('Reservation not found', ['reservation_id' => $id]);
            return redirect()->route('home')->with('error', 'Réservation introuvable.');
        }

        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Récupérer la session de paiement Stripe avec l'ID sauvegardé
            $checkout_session_id = session('checkout_session_id');
            if (!$checkout_session_id) {
                Log::warning('Checkout session ID not found', ['reservation_id' => $id]);
                return redirect()->route('home')->with('error', 'Session de paiement introuvable.');
            }

            // Mettre à jour l'ID de la facture Stripe et le statut de la réservation
            $reservation->stripe_invoice_id = $checkout_session_id;
            $reservation->status = StatusEnum::CONFIRMED;
            $reservation->save();

            // Event : Envoyer un email de confirmation
            event(new \App\Events\ReservationConfirmed($reservation));

            Log::info('Reservation status updated', ['reservation_id' => $reservation->id, 'status' => $reservation->status]);

            return view('reservation.confirmation', compact('reservation'))->with('success', 'Réservation confirmée avec succès.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('my-reservations.index')->with('error', 'Une erreur est survenue lors de la mise à jour de la réservation.');
        }
    }
    /**
     * Fonction qui gère l'annulation de la réservation et la libération des sièges
     * @param string $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */

    public function cancel(string $id)
    {
        Log::info('Cancel method called', ['reservation_id' => $id]);

        $reservation = Reservation::find($id);

        if (!$reservation) {
            Log::warning('Reservation not found', ['reservation_id' => $id]);
            return redirect()->route('home')->with('error', 'Réservation introuvable.');
        }
        $seats = $reservation->representation_reservations()
            ->get()
            ->map(function ($representationReservation) {
                return $representationReservation->seat;
            });
        foreach ($seats as $seat) {
            $seat->status = 'available';
            $seat->save();
        }

        $reservation->status = StatusEnum::CANCELED;
        $reservation->save();

        Log::info('Reservation status updated', ['reservation_id' => $reservation->id, 'status' => $reservation->status]);

        return view('reservation.cancel', compact('reservation'))->with('success', 'Réservation annulée avec succès.');
    }

    /**
     * Fonction qui gère l'affichage du panier de réservation en cours avec le total à payer
     * @return \Illuminate\Contracts\View\View
     * @throws \Throwable
     */

    public function cart()
    {
        $total = $this->calculateCartTotal();
        $reservations = Reservation::where('user_id', auth()->id())
            ->where('status', StatusEnum::PENDING)
            ->get();

        return view('reservation.cart.index', compact('reservations', 'total'))->with('success', 'Réservation ajoutée au panier');
    }
    /**
     * Fonction qui permet de supprimer une réservation du panier de réservation
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function remove(string $id)
    {
        try {
            $reservation = Reservation::find($id);

            if (!$reservation) {
                Log::warning('Reservation not found', ['reservation_id' => $id]);
                return redirect()->route('home')->with('error', 'Réservation introuvable.');
            }
            // Supprimer les entrées liées dans representation_reservation
            $reservation->representation_reservations()->delete();

            $reservation->delete();

            Log::info('Reservation deleted', ['reservation_id' => $reservation->id]);

            return redirect()->route('reservation.cart.remove')->with('success', 'Réservation supprimée');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Une erreur est survenue lors de la suppression de la réservation.');
        }
    }
    /**
     * Fonction qui permet de supprimer TOUS les réservations du panier de réservation
     */
    public function removeall()
    {
        try {
            $reservations = Reservation::where('user_id', auth()->id())
                ->where('status', StatusEnum::PENDING)
                ->get();

            foreach ($reservations as $reservation) {
                // Supprimer les entrées liées dans representation_reservation
                $reservation->representation_reservations()->delete();
                $reservation->delete();
            }

            return view('reservation.cart.removeall');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Une erreur est survenue lors de la suppression des réservations.');
        }
    }
    /**
     * Fonction qui permet de payer le panier de réservation en cours
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function payCart()
    {
        try {
            $total = $this->calculateCartTotal();

            if ($total <= 0) {
                return redirect()->route('reservation.cart')->with('error', 'Le panier est vide.');
            }

            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $checkout_session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'eur',
                        'unit_amount' => $total * 100,
                        'product_data' => [
                            // payement du panier entier
                            'name' => 'Paiement du panier',
                            'description' => 'Paiement du panier de réservation',
                        ],
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('reservation.confirmation', ['id' => 'reservation_id_placeholder']),
                'cancel_url' => route('reservation.cancel', ['id' => 'reservation_id_placeholder']),
                // Attentions /!\ : Activer la création de facture pour les paiements Checkout
                'invoice_creation' => [
                    'enabled' => true,
                ],
            ]);
            // Mettre à jour l'ID de la facture Stripe et le statut de la réservation
            $success_url = str_replace('reservation_id_placeholder', $checkout_session->id, route('reservation.confirmation', ['id' => $checkout_session->id]));
            $cancel_url = str_replace('reservation_id_placeholder', $checkout_session->id, route('reservation.cancel', ['id' => $checkout_session->id]));

            return redirect($checkout_session->url);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Une erreur est survenue lors du paiement.');
        }
    }
}
