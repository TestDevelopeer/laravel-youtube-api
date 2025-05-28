<?php

namespace Database\Seeders;

use App\Models\Channel;
use App\Models\Playlist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class PlaylistVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Playlist::with(['channel.videos'])
            ->get()
            ->each(
                fn(Playlist $playlist) => $playlist->videos()->saveMany($this->randomVideosFrom($playlist->channel))
            );
    }

    private function randomVideosFrom(Channel $channel): Collection
    {
        return $channel->videos->whenEmpty(
            fn() => collect(),
            fn(Collection $videos) => $videos->random(random_int(1, $videos->count()))
        );
    }
}
