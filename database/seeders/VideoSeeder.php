<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Show;
use App\Models\Video;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ajout d'une video pour le show
        $show = Show::first();

        Video::create([
            'title' => 'Tintin Video',
            'video_url' => 'https://youtu.be/ERA14Xjjtlk',
            'show_id' => $show->id,
        ]);
    }
}
