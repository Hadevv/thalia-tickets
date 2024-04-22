<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\RepresentationReservation;
use App\Models\Representation;
use App\Models\Show;
use Stripe\Stripe;
use Stripe\Invoice;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ReservationController;

class MyReservationController extends ReservationController
{
    public function index()
    {
        $reservations = Reservation::where('user_id', auth()->user()->id)
            ->with('representation_reservations')
            ->where ('status', 'confirmed')
            ->paginate(10);

        return view('my-reservations.index', compact('reservations'));
    }

    public function show($id)
    {
        $reservation = Reservation::where('id', $id)
            ->with('representation_reservations')
            ->firstOrFail();

        return view('my-reservations.show', compact('reservation'));
    }

    public function cancel($id)
    {
        try {
            $reservation = Reservation::where('user_id', auth()->user()->id)
                ->with('representation_reservations')
                ->where('status', 'confirmed')
                ->findOrFail($id);

            // faire appel à la méthode cancel de ReservationController
            return parent::cancel($id);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('my-reservations.index')->with('error', 'Une erreur est survenue lors de l\'annulation de la réservation.');
        }
    }
    public function downloadStripeInvoice($id)
    {
        $reservation = Reservation::where('id', $id)
            ->with('representation_reservations')
            ->firstOrFail();

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {

            $stripeInvoice = Invoice::retrieve($reservation->stripe_invoice_id);
            $pdfContent = $stripeInvoice->pdf(['future_usage' => 'off_session', 'network_retry_count' => 2]);

            // Renvoyez le PDF au navigateur
            return response($pdfContent)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename=facture_stripe.pdf');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('my-reservations.index')->with('error', 'Une erreur est survenue lors du téléchargement de la fiche de paye.');
        }
    }
}
