<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function index(): Collection
    {
        return Channel::all();
    }

    public function show(Channel $channel): Channel
    {
        return $channel;
    }
}
