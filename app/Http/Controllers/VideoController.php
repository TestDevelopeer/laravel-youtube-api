<?php

namespace App\Http\Controllers;

use App\Enums\Period;
use App\Models\Video;
use Illuminate\Pagination\Paginator;

class VideoController extends Controller
{
    public function index(): Paginator
    {
        return Video::withRelationships(request('with', []))
            ->fromPeriod(Period::tryFrom(request('period')))
            ->search(request('query'))
            ->orderBy(request('sort', 'created_at'), request('order', 'desc'))
            ->simplePaginate(request('limit'))
            ->withQueryString();
    }

    public function show(Video $video): Video
    {
        return $video->load(request('with', []));
    }
}
