<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Support\Collection;

class VideoController extends Controller
{
    public function index(): Collection
    {
        $date = match (request('period')) {
            'year' => now()->startOfYear(),
            'month' => now()->startOfMonth(),
            'week' => now()->startOfWeek(),
            'day' => now()->startOfDay(),
            'hour' => now()->startOfHour(),
            default => null,
        };

        return $date ? Video::where('created_at', '>=', $date)->get() : Video::get();
    }

    public function show(Video $video): Video
    {
        return $video->load(['channel', 'categories']);
    }
}
