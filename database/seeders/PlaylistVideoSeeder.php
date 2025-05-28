<?php

namespace Database\Seeders;

use App\Models\Playlist;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Random\RandomException;

class PlaylistVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $playlistIds = Playlist::pluck('id');
        $videoIds = Video::pluck('id');

        $playlistVideos = $playlistIds->flatMap(
            fn(int $id) => $this->playlistVideos($id, $this->randomVideoIds($videoIds))
        );

        DB::table('playlist_video')->insert($playlistVideos->all());
    }

    public function playlistVideos(int $playlistId, Collection $videoIds): Collection
    {
        return $videoIds->map(fn(int $id) => [
            'playlist_id' => $playlistId,
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
