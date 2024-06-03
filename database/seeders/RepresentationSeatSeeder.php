<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Representation;
use App\Models\Seat;

class RepresentationSeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $representations = Representation::all();
        $seats = Seat::all();

        foreach ($representations as $representation) {
            foreach ($seats as $seat) {
                DB::table('representation_seat')->insert([
                    'representation_id' => $representation->id,
                    'seat_id' => $seat->id,
                    'status' => 'available',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
