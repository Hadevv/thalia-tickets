<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Representation;
use App\Models\Location;
use App\Models\Show;

class RepresentationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Representation::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $representations = [
            [
                'location_slug' => 'espace-delvaux-la-venerie',
                'show_slug' => 'ayiti',
                'schedule' => '2012-10-12 13:30',
            ],
            [
                'location_slug' => 'dexia-art-center',
                'show_slug' => 'ayiti',
                'schedule' => '2012-10-12 20:30',
            ],
            [
                'location_slug' => null,
                'show_slug' => 'cible-mouvante',
                'schedule' => '2012-10-02 20:30',
            ],
            [
                'location_slug' => null,
                'show_slug' => 'ceci-nest-pas-un-chanteur-belge',
                'schedule' => '2012-10-16 20:30',
            ],
        ];

        foreach ($representations as &$data) {
            $location = Location::firstWhere('slug', $data['location_slug']);
            unset($data['location_slug']);

            $show = Show::firstWhere('slug', $data['show_slug']);
            unset($data['show_slug']);

            $data['location_id'] = $location->id ?? null;
            $data['show_id'] = $show->id;
        }
        unset($data);

        DB::table('representations')->insert($representations);
    }
}
