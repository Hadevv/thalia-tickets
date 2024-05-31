<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $videos = [
            [
                'title' => 'The Lion King',
                'video_url' => 'https://www.youtube.com/watch?v=4sj1MT05lAA',
                'show_id' => 1,
            ],
            [
                'title' => 'The Lion King',
                'video_url' => 'https://www.youtube.com/watch?v=4sj1MT05lAA',
                'show_id' => 2,
            ],
            [
                'title' => 'The Lion King',
                'video_url' => 'https://www.youtube.com/watch?v=4sj1MT05lAA',
                'show_id' => 3,
            ],
            [
                'title' => 'The Lion King',
                'video_url' => 'https://www.youtube.com/watch?v=4sj1MT05lAA',
                'show_id' => 4,
            ],
            [
                'title' => 'The Lion King',
                'video_url' => 'https://www.youtube.com/watch?v=4sj1MT05lAA',
                'show_id' => 5,
            ],
            [
                'title' => 'The Lion King',
                'video_url' => 'https://www.youtube.com/watch?v=4sj1MT05lAA',
                'show_id' => 6,
            ],
            [
                'title' => 'The Lion King',
                'video_url' => 'https://www.youtube.com/watch?v=4sj1MT05lAA',
                'show_id' => 7,
            ],
            [
                'title' => 'The Lion King',
                'video_url' => 'https://www.youtube.com/watch?v=4sj1MT05lAA',
                'show_id' => 8,
            ],
            [
                'title' => 'The Lion King',
                'video_url' => 'https://www.youtube.com/watch?v=4sj1MT05lAA',
                'show_id' => 9,
            ],
        ];

        foreach ($videos as $video) {
            \App\Models\Video::create($video);
        }
    }
}
