<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Empty the table first

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('prices')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $prices = [
            [
                'type' => 'Adulte',
                'price' => 24.00,
                'start_date' => '2012-10-01',
                'end_date' => '2012-12-31',
            ],

            [
                'type' => 'Étudiant',
                'price' => 10.00,
                'start_date' => '2012-10-01',
                'end_date' => null,
            ],

            [
                'type' => 'Senior',
                'price' => 18.00,
                'start_date' => '2012-10-01',
                'end_date' => null,
            ],

            [
                'type' => 'Adulte',
                'price' => 26.00,
                'start_date' => '2013-01-01',
                'end_date' => null,
            ],
        ];

        DB::table('prices')->insert($prices);
    }
}
