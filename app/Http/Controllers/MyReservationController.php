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
            ->with('representation_reservations.representation.show', 'representation_reservations.representation.location')
            ->where('status', 'confirmed')
            ->orderBy('booking_date', 'desc')
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
            // faire appel à la méthode cancel de ReservationController
            $result = parent::cancel($id);

            // Redirection après l'annulation réussie
            return redirect()->route('my-reservations.index')->with('success', 'La réservation a été annulée avec succès.');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('my-reservations.index')->with('error', 'Une erreur est survenue lors de l\'annulation de la réservation.');
        }
    }
    public function downloadStripeInvoice($id)
    {
        try {
            $reservation = Reservation::where('id', $id)
                ->where('user_id', auth()->user()->id)
                ->firstOrFail();

            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Récupérer l'ID de la facture à partir de la session Stripe Checkout
            $session_id = $reservation->stripe_invoice_id;
            $checkout_session = \Stripe\Checkout\Session::retrieve($session_id);
            $invoice_id = $checkout_session->invoice;

            if (!$invoice_id || strpos($invoice_id, 'in_') !== 0) {
                throw new \Exception('ID de facture Stripe invalide.');
            }

            $stripeInvoice = \Stripe\Invoice::retrieve($invoice_id);

            // Obtenir l'URL du PDF de la facture Stripe
            $pdfUrl = $stripeInvoice->invoice_pdf;

            // Supprimer les guillemets doubles de l'URL
            $pdfUrl = str_replace('"', '', $pdfUrl);

            Log::info('Stripe Invoice PDF URL:', ['pdf_url' => $pdfUrl]);

            // Redirection vers l'URL du PDF
            return redirect()->away($pdfUrl);

        } catch (\Stripe\Exception\ApiErrorException $e) {
            Log::error($e->getMessage());
            return redirect()->route('my-reservations.index')->with('error', 'Erreur Stripe: ' . $e->getMessage());

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('my-reservations.index')->with('error', 'Une erreur est survenue lors du téléchargement de la facture.');
        }
    }
}
