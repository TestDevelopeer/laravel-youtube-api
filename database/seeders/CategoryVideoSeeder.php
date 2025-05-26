<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryVideo = [];

        foreach (range(1, 10) as $i) {
            $categoryVideo[] = [
                'category_id' => $i,
                'video_id' => $i,
            ];
        }

        DB::table('category_video')->insert($categoryVideo);
    }
}
