<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::truncate();

        DB::table('types')->insert([
            ['type' => 'comédien'],
            ['type' => 'metteur en scène'],
            ['type' => 'auteur'],
            ['type' => 'scénographe'],
            ['type' => 'costumier'],
            ['type' => 'maquilleur'],
            ['type' => 'régisseur'],
            ['type' => 'technicien'],
            ['type' => 'administratif'],
            ['type' => 'communication'],
            ['type' => 'public'],
        ]);
    }
}
