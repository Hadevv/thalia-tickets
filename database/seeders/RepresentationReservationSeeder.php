<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Representation;
use App\Models\Show;
use App\Models\Location;
use App\Models\User;
use App\Models\Price;
use App\Models\Reservation;
use App\Models\Seat;
use App\Models\RepresentationSeat;

class RepresentationReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('representation_reservation')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $representationReservations = [
            [
                'show_slug' => 'ayiti',
                'location_slug' => 'dexia-art-center',
                'representation_date' => '2012-10-12 20:30:00',
                'user_login' => 'bob',
                'reservation_date' => '2012-10-10 10:00:00',
                'reservation_status' => null,
                'price_type' => 'Adulte',
                'price' => 24.00,
                'price_start_date' => '2012-10-01',
                'price_end_date' => '2012-12-31',
                'quantity' => 2,
            ],
            [
                'show_slug' => 'ayiti',
                'location_slug' => 'espace-delvaux-la-venerie',
                'representation_date' => '2012-10-12 13:30:00',
                'user_login' => 'antoine',
                'reservation_date' => '2012-10-08 10:00:00',
                'reservation_status' => null,
                'price_type' => 'Étudiant',
                'price' => 10.00,
                'price_start_date' => '2012-10-01',
                'price_end_date' => null,
                'quantity' => 1,
            ],
            [
                'show_slug' => 'cible-mouvante',
                'representation_date' => '2012-10-02 20:30:00',
                'user_login' => 'john',
                'reservation_date' => '2012-10-15 10:00:00',
                'reservation_status' => null,
                'price_type' => 'Senior',
                'price' => 18.00,
                'price_start_date' => '2012-10-01',
                'price_end_date' => null,
                'quantity' => 1,
            ],
        ];

        foreach ($representationReservations as &$representationReservation) {
            $show = Show::where('slug', $representationReservation['show_slug'])->first();
            if (!$show) {
                continue; // Show not found, skip this iteration
            }

            $locationId = null;
            if (!empty($representationReservation['location_slug'])) {
                $location = Location::where('slug', $representationReservation['location_slug'])->first();
                $locationId = $location ? $location->id : null;
            }

            $representationQuery = Representation::where('show_id', $show->id)
                ->where('schedule', $representationReservation['representation_date']);
            if ($locationId !== null) {
                $representationQuery->where('location_id', $locationId);
            } else {
                $representationQuery->whereNull('location_id');
            }

            $representation = $representationQuery->first();
            if (!$representation) {
                continue; // Representation not found, skip this iteration
            }

            $user = User::where('login', $representationReservation['user_login'])->first();
            if (!$user) {
                continue; // User not found, skip this iteration
            }

            $reservation = Reservation::where('user_id', $user->id)
                ->where('booking_date', $representationReservation['reservation_date'])
                ->where('status', $representationReservation['reservation_status'])
                ->first();
            if (!$reservation) {
                continue; // Reservation not found, skip this iteration
            }

            $price = Price::where('type', $representationReservation['price_type'])
                ->where('price', $representationReservation['price'])
                ->where('start_date', $representationReservation['price_start_date'])
                ->where('end_date', $representationReservation['price_end_date'])
                ->first();
            if (!$price) {
                continue; // Price not found, skip this iteration
            }

            $seat = Seat::where('seat_number', 'A1')->first();
            if (!$seat) {
                continue; // Seat not found, skip this iteration
            }

            $representationSeat = RepresentationSeat::where('representation_id', $representation->id)
                ->where('seat_id', $seat->id)
                ->first();
            if (!$representationSeat) {
                continue; // RepresentationSeat not found, skip this iteration
            }

            // Supprimez les colonnes utilisées pour trouver les enregistrements
            unset($representationReservation['show_slug']);
            unset($representationReservation['location_slug']);
            unset($representationReservation['representation_date']);
            unset($representationReservation['user_login']);
            unset($representationReservation['price_type']);
            unset($representationReservation['price']);
            unset($representationReservation['price_start_date']);
            unset($representationReservation['price_end_date']);
            unset($representationReservation['reservation_date']);
            unset($representationReservation['reservation_status']);

            // Ajoutez les colonnes correctes pour l'insertion
            $representationReservation['representation_seat_id'] = $representationSeat->id;
            $representationReservation['price_id'] = $price->id;
            $representationReservation['reservation_id'] = $reservation->id;
        }
        unset($representationReservation);

        DB::table('representation_reservation')->insert($representationReservations);
    }
}
