<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): Collection
    {
        return Category::with('videos')->get();
    }

    public function show(Category $category): Category
    {
        return $category->load('videos');
    }
}
