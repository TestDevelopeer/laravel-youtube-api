<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(): Collection
    {
        return Video::with(['channel', 'categories'])->get();
    }

    public function show(Video $video): Video
    {
        return $video->load(['channel', 'categories']);
    }
}
