<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Artist;
use App\Models\Type;
use App\Models\ArtistType;
use App\Models\Show;

class ArtistTypeShowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('artist_type_show')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $artistTypeShows = [
            [
                'artist_firstname' => 'Daniel',
                'artist_lastname' => 'Marcelin',
                'type' => 'auteur',
                'show_slug' => 'ayiti',
            ],
            [
                'artist_firstname' => 'Philippe',
                'artist_lastname' => 'Laurent',
                'type' => 'auteur',
                'show_slug' => 'ayiti',
            ],
            [
                'artist_firstname' => 'Daniel',
                'artist_lastname' => 'Marcelin',
                'type' => 'scénographe',
                'show_slug' => 'ayiti',
            ],
            [
                'artist_firstname' => 'Philippe',
                'artist_lastname' => 'Laurent',
                'type' => 'scénographe',
                'show_slug' => 'ayiti',
            ],
            [
                'artist_firstname' => 'Daniel',
                'artist_lastname' => 'Marcelin',
                'type' => 'comédien',
                'show_slug' => 'ayiti',
            ],
            [
                'artist_firstname' => 'Marius',
                'artist_lastname' => 'Von Mayenburg',
                'type' => 'auteur',
                'show_slug' => 'cible-mouvante',
            ],
            [
                'artist_firstname' => 'Olivier',
                'artist_lastname' => 'Boudon',
                'type' => 'scénographe',
                'show_slug' => 'cible-mouvante',
            ],
            [
                'artist_firstname' => 'Anne Marie',
                'artist_lastname' => 'Loop',
                'type' => 'comédien',
                'show_slug' => 'cible-mouvante',
            ],
            [
                'artist_firstname' => 'Pietro',
                'artist_lastname' => 'Varasso',
                'type' => 'comédien',
                'show_slug' => 'cible-mouvante',
            ],
            [
                'artist_firstname' => 'Laurent',
                'artist_lastname' => 'Caron',
                'type' => 'comédien',
                'show_slug' => 'cible-mouvante',
            ],
            [
                'artist_firstname' => 'Élena',
                'artist_lastname' => 'Perez',
                'type' => 'comédien',
                'show_slug' => 'cible-mouvante',
            ],
            [
                'artist_firstname' => 'Guillaume',
                'artist_lastname' => 'Alexandre',
                'type' => 'comédien',
                'show_slug' => 'cible-mouvante',
            ],
            [
                'artist_firstname' => 'Claude',
                'artist_lastname' => 'Semal',
                'type' => 'auteur',
                'show_slug' => 'ceci-nest-pas-un-chanteur-belge',
            ],
            [
                'artist_firstname' => 'Laurence',
                'artist_lastname' => 'Warin',
                'type' => 'scénographe',
                'show_slug' => 'ceci-nest-pas-un-chanteur-belge',
            ],
            [
                'artist_firstname' => 'Claude',
                'artist_lastname' => 'Semal',
                'type' => 'comédien',
                'show_slug' => 'ceci-nest-pas-un-chanteur-belge',
            ],
            [
                'artist_firstname' => 'Pierre',
                'artist_lastname' => 'Wayburn',
                'type' => 'auteur',
                'show_slug' => 'manneke',
            ],
            [
                'artist_firstname' => 'Gwendoline',
                'artist_lastname' => 'Gauthier',
                'type' => 'auteur',
                'show_slug' => 'manneke',
            ],
            [
                'artist_firstname' => 'Philippe',
                'artist_lastname' => 'Laurent',
                'type' => 'scénographe',
                'show_slug' => 'manneke',
            ],
            [
                'artist_firstname' => 'Pierre',
                'artist_lastname' => 'Wayburn',
                'type' => 'comédien',
                'show_slug' => 'manneke',
            ],
            [
                'artist_firstname' => 'Gwendoline',
                'artist_lastname' => 'Gauthier',
                'type' => 'comédien',
                'show_slug' => 'manneke',
            ],

            [
                'artist_firstname' => 'Slawomir',
                'artist_lastname' => 'Mrozek',
                'type' => 'auteur',
                'show_slug' => 'emigres',
            ]
        ];

        foreach ($artistTypeShows as &$data) {
            $artist = Artist::where([
                ['firstname', '=', $data['artist_firstname']],
                ['lastname', '=', $data['artist_lastname']]
            ])->first();

            $type = Type::firstWhere('type', $data['type']);

            $artistType = ArtistType::where([
                ['artist_id', '=', $artist->id],
                ['type_id', '=', $type->id]
            ])->first();

            $show = Show::firstWhere('slug', $data['show_slug']);

            unset($data['artist_firstname']);
            unset($data['artist_lastname']);
            unset($data['type']);
            unset($data['show_slug']);

            $data['artist_type_id'] = $artistType->id;
            $data['show_id'] = $show->id;
        }
        unset($data);

        DB::table('artist_type_show')->insert($artistTypeShows);
    }
}
