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

        return Video::with(request('with', []))
            ->fromPeriod($period)
            ->search(request('query'))
            ->limit(request('limit'))
            ->orderBy(request('sort', 'created_at'), request('order', 'asc'))
            ->get();
    }

    public function show(Video $video): Video
    {
        return $video->load(request('with', []));
    }
}
