<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Random\RandomException;

class CategoryVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $videos = Video::get();

        Category::get()->flatMap(
            fn(Category $category) => $category->videos()->saveMany($this->randomVideos($videos))
        );
    }

    /**
     * @throws RandomException
     */
    private function randomVideos(Collection $videos): Collection
    {
        return $videos->random(random_int(1, $videos->count()));
    }
}
