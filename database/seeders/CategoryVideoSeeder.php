<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Random\RandomException;

class CategoryVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryIds = Category::pluck('id');
        $videoIds = Video::pluck('id');

        $categoryVideos = $categoryIds->flatMap(
            fn(int $id) => $this->categoryVideos($id, $this->randomVideoIds($videoIds))
        );

        DB::table('category_video')->insert($categoryVideos->all());
    }

    public function categoryVideos(int $categoryId, Collection $videoIds): Collection
    {
        return $videoIds->map(fn(int $id) => [
            'category_id' => $categoryId,
            'video_id' => $id,
        ]);
    }

    /**
     * @throws RandomException
     */
    private function randomVideoIds(Collection $ids): Collection
    {
        return $ids->random(random_int(1, count($ids)));
    }
}
