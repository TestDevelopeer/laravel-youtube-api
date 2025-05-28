<?php

namespace App\Http\Controllers;

use App\Enums\Period;
use App\Models\Video;
use Illuminate\Pagination\Paginator;

class VideoController extends Controller
{
    public function index(): Paginator
    {
        $period = Period::tryFrom(request('period'));

        return Video::with(request('with', []))
            ->fromPeriod($period)
            ->search(request('query'))
            ->orderBy(request('sort', 'created_at'), request('order', 'asc'))
            ->simplePaginate(request('limit'))
            ->withQueryString();
    }

    public function show(Video $video): Video
    {
        return $video->load(request('with', []));
    }
}
