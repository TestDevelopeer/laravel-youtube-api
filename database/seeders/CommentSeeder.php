<?php

namespace Database\Seeders;

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
            ->flatMap
            ->createRandomComments()
            ->each
            ->associateParentComment();
    }
}
