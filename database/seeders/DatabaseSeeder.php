<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            TypeSeeder::class,
            LocalitySeeder::class,
            LocationSeeder::class,
            ArtistSeeder::class,
            RoleSeeder::class,
            ShowSeeder::class,
            RepresentationSeeder::class,
            ArtistTypeSeeder::class,
            ArtistTypeShowSeeder::class,
            UserSeeder::class,
            UserRoleSeeder::class,
            PriceSeeder::class,
            ReservationSeeder::class,
            RepresentationReservationSeeder::class,
            ReviewSeeder::class,
            TagSeeder::class,
            ShowTagSeeder::class,
            VideoSeeder::class,

        ]);
    }
}
