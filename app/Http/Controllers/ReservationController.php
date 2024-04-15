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

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

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
    }

    public function confirmation(string $id)
    {
        $reservation = Reservation::find($id);
        $reservation->status = 'confirmed';
        $reservation->save();

        return view('reservation.confirmation');
    }

    public function cancel(string $id)
    {
        $reservation = Reservation::find($id);
        $reservation->status = 'canceled';
        $reservation->save();

        return view('reservation.cancel');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
