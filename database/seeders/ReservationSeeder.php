<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('reservations')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $reservations = [
            [
                'user_login' => 'bob',
                'booking_date' => '2012-10-10 10:00:00',
                'status' => null,
            ],
            [
                'user_login' => 'antoine',
                'booking_date' => '2012-10-08 10:00:00',
                'status' => null,
            ],
            [
                'user_login' => 'john',
                'booking_date' => '2012-10-15 10:00:00',
                'status' => null,
            ],
        ];

        foreach ($reservations as &$data) {
            $user = User::firstWhere('login', $data['user_login']);
            unset($data['user_login']);

            $data['user_id'] = $user->id;
        }

        DB::table('reservations')->insert($reservations);
    }
}

