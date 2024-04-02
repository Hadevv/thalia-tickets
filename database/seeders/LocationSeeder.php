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
                'slug' => null,
                'designation' => 'Espace Delvaux / La Vénerie',
                'address' => '3 rue Gratès',
                'locality_postal_code' => '1170',
                'website' => 'https://www.lavenerie.be',
                'phone' => '+32 (0)2/663.85.50',
            ],
            [
                'slug' => null,
                'designation' => 'Dexia Art Center',
                'address' => '50 rue de l\'Ecuyer',
                'locality_postal_code' => '1000',
                'website' => null,
                'phone' => null,
            ],
            [
                'slug' => null,
                'designation' => 'La Samaritaine',
                'address' => '16 rue de la samaritaine',
                'locality_postal_code' => '1000',
                'website' => 'http://www.lasamaritaine.be/',
                'phone' => null,
            ],
            [
                'slug' => null,
                'designation' => 'Espace Magh',
                'address' => '17 rue du Poinçon',
                'locality_postal_code' => '1000',
                'website' => 'http://www.espacemagh.be',
                'phone' => '+32 (0)2/274.05.10',
            ],
        ];

        foreach ($locations as &$data) { //& permet de modifier directement la valeur de l'élément dans le tableau en l'occurrence $data
            //Recherche de la localité correspondant au code postal
            $locality = Locality::firstWhere('postal_code', $data['locality_postal_code']); // firstWhere() permet de récupérer la première occurrence correspondant à la condition donnée
            unset($data['locality_postal_code']); //unset() permet de supprimer un élément du tableau

            // on supprime la clé 'locality_postal_code' car elle ne correspond pas à une colonne de la table locations

            // le postal_code se trouve dans la table localities

            $data['slug'] = Str::slug($data['designation'], '-'); //Str::slug() permet de générer un slug à partir d'une chaîne de caractères et prend en paramètre la chaîne de caractères et le séparateur
            $data['locality_id'] = $locality->id;    //Référence à la table localities
        }

        DB::table('locations')->insert($locations);
    }
}
