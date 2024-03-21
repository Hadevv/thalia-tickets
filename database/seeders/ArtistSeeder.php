<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Artist;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        Artist::truncate();

        $artists = [
            ['firstname' => 'Daniel', 'lastname' => 'Marcelin'],
            ['firstname' => 'Philippe', 'lastname' => 'Laurent'],
            ['firstname' => 'Marius', 'lastname' => 'Von Mayenburg'],
            ['firstname' => 'Olivier', 'lastname' => 'Boudon'],
            ['firstname' => 'Anne Marie', 'lastname' => 'Loop'],
            ['firstname' => 'Pietro', 'lastname' => 'Varasso'],
            ['firstname' => 'Laurent', 'lastname' => 'Caron'],
            ['firstname' => 'Élena', 'lastname' => 'Perez'],
            ['firstname' => 'Guillaume', 'lastname' => 'Alexandre'],
            ['firstname' => 'Claude', 'lastname' => 'Semal'],
            ['firstname' => 'Laurence', 'lastname' => 'Warin'],
            ['firstname' => 'Pierre', 'lastname' => 'Wayburn'],
            ['firstname' => 'Gwendoline', 'lastname' => 'Gauthier'],
        ];

        DB::table('artists')->insert($artists);
    }
}
