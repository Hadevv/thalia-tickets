<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;
use App\Models\Show;

class ShowTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks to allow truncation
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        // Truncate the pivot table
        DB::table('show_tag')->truncate();
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Define the data to seed
        $data = [
            [
                'show_slug' => 'le-malade-imaginaire',
                'tag' => 'masterclass',
            ],
            [
                'show_slug' => 'cible-mouvante',
                'tag' => 'théâtre',
            ],
            [
                'show_slug' => 'ayiti',
                'tag' => 'musique',
            ]
        ];

        // Loop through each entry in the data array
        foreach ($data as $row) {
            // Retrieve the show model by its slug
            $show = Show::where('slug', $row['show_slug'])->first();
            // Retrieve the tag model by its name
            $tag = Tag::where('tag', $row['tag'])->first();

            // Check if both show and tag exist
            if ($show && $tag) {
                // Attach the tag to the show
                $show->tags()->attach($tag->id);
            }
        }
    }
}
