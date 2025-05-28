<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Pagination\Paginator;

class ChannelController extends Controller
{
    public function index(): Paginator
    {
        return Channel::with(request('with', []))
            ->search(request('query'))
            ->orderBy(request('sort', 'name'), request('order', 'asc'))
            ->simplePaginate(request('limit'))
            ->withQueryString();
    }

    public function show(Channel $channel): Channel
    {
        return $channel->load(request('with', []));
    }
}
