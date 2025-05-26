<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $videos = [];

        foreach (range(1, 10) as $i) {
            $videos[] = [
                'title' => 'Video #' . $i,
                'channel_id' => $i,
            ];
        }

        DB::table('videos')->insert($videos);
    }
}
