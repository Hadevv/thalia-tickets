<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Show;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('reviews')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $reviews = [
            [
                'user_login' => 'bob',
                'show_slug' => 'cible-mouvante',
                'review' => 'Super spectacle !',
                'stars' => 4,
            ],
            [
                'user_login' => 'john',
                'show_slug' => 'cible-mouvante',
                'review' => 'J\'ai adoré !',
                'stars' => 5,
            ],
            [
                'user_login' => 'jane',
                'show_slug' => 'cible-mouvante',
                'review' => 'Je recommande !',
                'stars' => 4,
            ],
            [
                'user_login' => 'antoine',
                'show_slug' => 'cible-mouvante',
                'review' => 'A voir absolument !',
                'stars' => 5,
            ],
        ];

        foreach ($reviews as &$data) {
            $user = User::firstWhere('login', $data['user_login']);

            $show = Show::firstWhere('slug', $data['show_slug']);

            unset($data['user_login']);
            unset($data['show_slug']);

            $data['user_id'] = $user->id;
            $data['show_id'] = $show->id;
        }
        DB::table('reviews')->insert($reviews);
    }
}
