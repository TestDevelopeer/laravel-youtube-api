<?php

namespace Database\Seeders;

use App\Models\Channel;
use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Channel::factory(40)
            ->sequence(fn($sequence) => [
                'user_id' => $sequence->index + 1
            ])
            ->create();
    }
}
