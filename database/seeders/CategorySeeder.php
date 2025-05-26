<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [];

        foreach (range(1, 10) as $i) {
            $categories[] = [
                'name' => 'Category ' . $i,
            ];
        }

        DB::table('categories')->insert($categories);
    }
}
