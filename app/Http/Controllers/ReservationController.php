<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use Laravel\Cashier\Cashier;
use App\Models\Price;
use App\Models\Representation;
use App\Models\RepresentationReservation;
use App\Http\Controllers\PaymentController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Invoice;
use Stripe\PaymentIntent;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function calculateCartTotal()
    {
        $reservations = Reservation::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->get();

        $total = $reservations->map(function ($reservation) {
            return $reservation->total();
        })->sum();

        return $total;
    }

    public function checkout(Request $request)
    {
        try {
            $action = $request->input('action');

            $request->validate([
                'representation_id' => 'required|exists:representations,id',
                'places.adulte' => 'nullable|integer|min:0',
                'places.enfant' => 'nullable|integer|min:0',
                'places.senior' => 'nullable|integer|min:0',
            ]);

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

            $line_items = [];
            foreach ($request->get('places') as $type => $quantity) {
                if ($quantity > 0) {
                    $price = $currentPrices->firstWhere('type', $type);
                    if ($price) {
                        $scheduleDate = \Carbon\Carbon::parse($representation->schedule);
                        RepresentationReservation::create([
                            'representation_id' => $representationId,
                            'reservation_id' => $reservationId,
                            'price_id' => $price->id,
                            'quantity' => $quantity,
                        ]);
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
                            'quantity' => $quantity,
                        ];
                    }
                }
            }

            if ($action === 'addToCart') {
                return redirect()->route('reservation.cart')->with('success', 'Réservation ajoutée au panier');
            }

            // Création de la session de paiement Stripe Checkout
            $checkout_session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $line_items,
                'mode' => 'payment',
                'success_url' => route('reservation.confirmation', ['id' => $reservation->id]),
                'cancel_url' => route('reservation.cancel', ['id' => $reservation->id]),
                // Attentions /!\
                'invoice_creation' => [
                    'enabled' => true,
                ],
            ]);
            $reservation->stripe_invoice_id = $checkout_session->id;
            $reservation->save();

            session(['checkout_session_id' => $checkout_session->id]);

            return redirect($checkout_session->url);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Une erreur est survenue lors de la création de la réservation.');
        }
    }

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
            $reservation->status = 'confirmed';
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


    public function cancel(string $id)
    {
        Log::info('Cancel method called', ['reservation_id' => $id]);

        $reservation = Reservation::find($id);

        if (!$reservation) {
            Log::warning('Reservation not found', ['reservation_id' => $id]);
            return redirect()->route('home')->with('error', 'Réservation introuvable.');
        }

        $reservation->status = 'canceled';
        $reservation->save();

        Log::info('Reservation status updated', ['reservation_id' => $reservation->id, 'status' => $reservation->status]);

        return view('reservation.cancel', compact('reservation'))->with('success', 'Réservation annulée avec succès.');
    }

    // Panier de réservation

    public function cart()
    {
        $total = $this->calculateCartTotal();
        $reservations = Reservation::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->get();

        return view('reservation.cart.index', compact('reservations', 'total'))->with('success', 'Réservation ajoutée au panier');
    }

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

    public function removeall()
    {
        try {
            $reservations = Reservation::where('user_id', auth()->id())
                ->where('status', 'pending')
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
            ]);

            $success_url = str_replace('reservation_id_placeholder', $checkout_session->id, route('reservation.confirmation', ['id' => $checkout_session->id]));
            $cancel_url = str_replace('reservation_id_placeholder', $checkout_session->id, route('reservation.cancel', ['id' => $checkout_session->id]));

            return redirect($checkout_session->url);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Une erreur est survenue lors du paiement.');
        }
    }
}
