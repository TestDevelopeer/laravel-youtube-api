<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Random\RandomException;

class CategoryVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws RandomException
     */
    public function run(): void
    {
        $categoryIds = Category::pluck('id')->all();
        $videoIds = Video::pluck('id')->all();

        $categoryVideo = [];

        foreach ($categoryIds as $categoryId) {
            $randomVideoIds = Arr::random($videoIds, random_int(1, count($videoIds)));

            foreach ($randomVideoIds as $videoId) {
                $categoryVideo[] = [
                    'category_id' => $categoryId,
                    'video_id' => $videoId,
                ];
            }
        }

        DB::table('category_video')->insert($categoryVideo);
    }
}
