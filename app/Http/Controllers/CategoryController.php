<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryController extends Controller
{
    public function index(): Collection
    {
        return Category::withRelationships(request('with'))
            ->search(request('query'))
            ->orderBy(request('sort', 'name'), request('order', 'asc'))
            ->simplePaginate(request('limit'))
            ->withQueryString();
    }

    public function show(Category $category): Category
    {
        return $category->loadRelationships(request('with'));
    }
}
