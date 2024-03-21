<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Location;
use App\Models\Locality;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Location::truncate();

        $locations = [
            [
                'slug'=>null,
                'designation'=>'Espace Delvaux / La Vénerie',
                'address'=>'3 rue Gratès',
                'locality_postal_code'=>'1170',
                'website'=>'https://www.lavenerie.be',
                'phone'=>'+32 (0)2/663.85.50',
            ],
            [
                'slug'=>null,
                'designation'=>'Dexia Art Center',
                'address'=>'50 rue de l\'Ecuyer',
                'locality_postal_code'=>'1000',
                'website'=>null,
                'phone'=>null,
            ],
            [
                'slug'=>null,
                'designation'=>'La Samaritaine',
                'address'=>'16 rue de la samaritaine',
                'locality_postal_code'=>'1000',
                'website'=>'http://www.lasamaritaine.be/',
                'phone'=>null,
            ],
            [
                'slug'=>null,
                'designation'=>'Espace Magh',
                'address'=>'17 rue du Poinçon',
                'locality_postal_code'=>'1000',
                'website'=>'http://www.espacemagh.be',
                'phone'=>'+32 (0)2/274.05.10',
            ],
        ];

        foreach ($locations as &$data) {
            // Recherchez la localité en utilisant le code postal
            $locality = Locality::firstWhere('postal_code', $data['locality_postal_code']);
            unset($data['locality_postal_code']);

            $data['slug'] = Str::slug($data['designation'], '-');
            // Assurez-vous que la localité existe
            if ($locality) {
                $data['locality_id'] = $locality->id;
            } else {
                // Si la localité n'existe pas, traitez l'erreur ici
            }
        }

        DB::table('locations')->insert($locations);
    }
}
