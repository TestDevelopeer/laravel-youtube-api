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

        return Video::fromPeriod($period)
            ->search(request('query'))
            ->get();
    }

    public function show(Video $video): Video
    {
        return $video->load(['channel', 'categories']);
    }
}
