<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('seats')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $seats = [
            ['seat_number' => 'A1', 'status' => 'available'],
            ['seat_number' => 'A2', 'status' => 'available'],
            ['seat_number' => 'A3', 'status' => 'available'],
            ['seat_number' => 'A4', 'status' => 'available'],
            ['seat_number' => 'A5', 'status' => 'available'],
            ['seat_number' => 'A6', 'status' => 'available'],
            ['seat_number' => 'A7', 'status' => 'available'],
            ['seat_number' => 'A8', 'status' => 'available'],
            ['seat_number' => 'A9', 'status' => 'available'],
            ['seat_number' => 'A10', 'status' => 'available'],
            ['seat_number' => 'B1', 'status' => 'available'],
            ['seat_number' => 'B2', 'status' => 'available'],
            ['seat_number' => 'B3', 'status' => 'available'],
            ['seat_number' => 'B4', 'status' => 'available'],
            ['seat_number' => 'B5', 'status' => 'available'],
            ['seat_number' => 'B6', 'status' => 'available'],
            ['seat_number' => 'B7', 'status' => 'available'],
            ['seat_number' => 'B8', 'status' => 'available'],
            ['seat_number' => 'B9', 'status' => 'available'],
            ['seat_number' => 'B10', 'status' => 'available'],
        ];

        DB::table('seats')->insert($seats);
    }
}
