<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ChannelSeeder::class,
            VideoSeeder::class,
            CategorySeeder::class,
            CategoryVideoSeeder::class,
            PlaylistSeeder::class,
            PlaylistVideoSeeder::class,
            CommentSeeder::class,
        ]);

//        User::factory(10)->has(
//            Channel::factory()->has(
//                Video::factory(10)->has(
//                    Category::factory(10)
//                )
//            )
//        )->create();

//        Video::factory(5)->hasCategories(3)->create();
    }
}
