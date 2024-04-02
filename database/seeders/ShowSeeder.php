<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Location;
use App\Models\Show;

class ShowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Show::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        //Define data
        $shows = [
            [
                'slug' => null,
                'title' => 'Ayiti',
                'description' => "Un homme est bloqué à l'aéroport.\n "
                    . 'Questionné par les douaniers, il doit alors justifier son identité, '
                    . 'et surtout prouver qu\'il est haïtien - qu\'est-ce qu\'être haïtien ?',
                'poster_url' => 'ayiti.jpg',
                'duration' => 90,
                'created_in' => 2010,
                'location_slug' => 'espace-delvaux-la-venerie',
                'bookable' => true,
            ],
            [
                'slug' => null,
                'title' => 'Cible mouvante',
                'description' => 'Dans ce « thriller d\'anticipation », des adultes semblent alimenter '
                    . 'et véhiculer une crainte féroce envers les enfants âgés entre 10 et 12 ans.',
                'poster_url' => 'cible.jpg',
                'duration' => 75,
                'created_in' => 2018,
                'location_slug' => 'dexia-art-center',
                'bookable' => true,
            ],
            [
                'slug' => null,
                'title' => 'Ceci n\'est pas un chanteur belge',
                'description' => "Non peut-être ?!\nEntre Magritte (pour le surréalisme comique) "
                    . 'et Maigret (pour le réalisme mélancolique), ce dixième opus semalien propose '
                    . 'quatorze nouvelles chansons mêlées à de petits textes humoristiques et '
                    . 'à quelques fortes images poétiques.',
                'poster_url' => 'claudebelgesaison220.jpg',
                'duration' => 80,
                'created_in' => 2012,
                'location_slug' => 'centre-culturel-des-riches-claires',
                'bookable' => true,
            ],
            [
                'slug' => null,
                'title' => 'Manneke… !',
                'description' => 'A tour de rôle, Pierre se joue de ses oncles, '
                    . 'tantes, grands-parents et surtout de sa mère.',
                'poster_url' => 'wayburn.jpg',
                'duration' => 80,
                'created_in' => 2012,
                'location_slug' => 'la-samaritaine',
                'bookable' => true,
            ],

            [
                'slug' => null,
                'title' => 'Èmigrés',
                'description' => 'Le titre banal ne présage pas de sa force. '
                    . 'Les Émigrés  est une pièce contemporaine au texte saturé d\'esprit et défendue par deux comédiens aussi talentueux qu\'attachants.'
                    . 'Une pièce très drôle qu\'il faut ne pas rater.',
                'poster_url' => 'emigres.jpg',
                'duration' => 90,
                'created_in' => 2012,
                'location_slug' => 'espace-magh',
                'bookable' => false,
            ]
        ];

        foreach ($shows as &$data) {
            $location = Location::firstWhere('slug', $data['location_slug']);
            unset($data['location_slug']);

            $data['slug'] = Str::slug($data['title'], '-');
            $data['location_id'] = $location->id ?? null;
        }
        unset($data);
        DB::table('shows')->insert($shows);
    }
}
