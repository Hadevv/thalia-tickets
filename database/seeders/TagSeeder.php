<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks to prevent issues with constraints
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Truncate the table to start fresh
        DB::table('tags')->truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Insert tags into the table
        DB::table('tags')->insert([
            ['tag' => 'spectacles'],
            ['tag' => 'théâtre'],
            ['tag' => 'concert'],
            ['tag' => 'exposition'],
            ['tag' => 'cinéma'],
            ['tag' => 'musée'],
            ['tag' => 'festival'],
            ['tag' => 'conférence'],
            ['tag' => 'atelier'],
            ['tag' => 'stage'],
            ['tag' => 'masterclass'],
            ['tag' => 'clown'],
            ['tag' => 'cirque'],
            ['tag' => 'danse'],
            ['tag' => 'opéra'],
            ['tag' => 'musique'],
            ['tag' => 'théâtre musical'],
            ['tag' => 'théâtre de rue'],
            ['tag' => 'théâtre d\'objet'],
            ['tag' => 'théâtre d\'improvisation'],
            ['tag' => 'théâtre de marionnettes'],
            ['tag' => 'théâtre de papier'],
            ['tag' => 'théâtre de masques'],
            ['tag' => 'théâtre de gestes'],
            ['tag' => 'théâtre de boulevard'],
        ]);
    }
}
