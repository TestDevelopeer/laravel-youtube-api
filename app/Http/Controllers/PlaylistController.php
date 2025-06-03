<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Pagination\Paginator;

class PlaylistController extends Controller
{
    public function index(): Paginator
    {
        return Playlist::withRelationships(request('with'))
            ->search(request('query'))
            ->orderBy(request('sort', 'name'), request('order', 'asc'))
            ->simplePaginate(request('limit'))
            ->withQueryString();
    }

    public function show(Playlist $playlist): Playlist
    {
        return $playlist->loadRelationships(request('with'));
    }
}
