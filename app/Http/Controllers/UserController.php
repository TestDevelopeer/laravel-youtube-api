<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): Collection{
        return User::with('channel')->get();
    }

    public function show(User $user): User
    {
        return $user->load('channel');
    }
}
