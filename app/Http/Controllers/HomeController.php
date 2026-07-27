<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::select('id', 'name', 'slug', 'image', 'description')
            ->withCount(['recipes' => fn($q) => $q->where('status', 'approved')])
            ->get();

        $featuredRecipes = Recipe::with(['category', 'images'])
            ->approved()
            ->latest()
            ->take(6)
            ->get();

        return Inertia::render('Index', [
            'categories' => $categories,
            'featuredRecipes' => $featuredRecipes,
        ]);
    }
}
