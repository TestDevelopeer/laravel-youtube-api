<?php

namespace Database\Seeders;

use App\Enums\Period;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Random\RandomException;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws RandomException
     */
    public function run(): void
    {
        collect(Period::cases())
            ->each(fn(Period $period) => Video::factory(random_int(2, 20))->last($period)->create());
    }
}
