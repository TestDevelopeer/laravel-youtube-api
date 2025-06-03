<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Pagination\Paginator;

class UserController extends Controller
{
    public function index(): Paginator
    {
        return User::withRelationships(request('with'))
            ->search(request('query'))
            ->orderBy(request('sort', 'name'), request('order', 'asc'))
            ->simplePaginate(request('limit'))
            ->withQueryString();
    }

    public function show(User $user): User
    {
        return $user->loadRelationships(request('with'));
    }
}
