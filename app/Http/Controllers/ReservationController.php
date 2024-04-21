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

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::where('user_id', auth()->id())->get();
        return view('reservation.index', compact('reservations'));
    }

    public function checkout(Request $request)
    {
        try {

            $request->validate([
                'representation_id' => 'required|exists:representations,id',
                'places.adulte' => 'nullable|integer|min:0',
                'places.enfant' => 'nullable|integer|min:0',
                'places.senior' => 'nullable|integer|min:0',
            ]);

            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $reservation = new Reservation([
                'user_id' => auth()->id(),
                'booking_date' => now(),
                'status' => 'pending',
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

            $checkout_session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $line_items,
                'mode' => 'payment',
                'success_url' => route('reservation.confirmation', ['id' => $reservation->id]),
                'cancel_url' => route('reservation.cancel', ['id' => $reservation->id]),
            ]);
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

        $reservation->status = 'confirmed';
        $reservation->save();

        Log::info('Reservation status updated', ['reservation_id' => $reservation->id, 'status' => $reservation->status]);

        return view('reservation.confirmation', compact('reservation'))->with('success', 'Réservation confirmée avec succès.');
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
        $reservations = Reservation::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->get();

        return view('reservation.cart.index', compact('reservations'))->with('success', 'Réservation ajoutée au panier');
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
}
