<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Video;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Video::take(3)->get()
            ->each(fn(Video $video) => Comment::factory(10)->create(['video_id' => $video->id]));
    }
}
