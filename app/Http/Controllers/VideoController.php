<?php

namespace App\Http\Controllers;

use App\Enums\Period;
use App\Models\Video;
use Illuminate\Support\Collection;

class VideoController extends Controller
{
    public function index(): Collection
    {
        $period = Period::tryFrom(request('period'));

        return $period
            ? Video::where('created_at', '>=', $period->date())->get()
            : Video::get();
    }

    public function show(Video $video): Video
    {
        return $video->load(['channel', 'categories']);
    }
}
