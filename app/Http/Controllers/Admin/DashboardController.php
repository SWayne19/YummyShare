<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'totalUsers' => User::count(),
                'totalRecipes' => Recipe::count(),
                'pendingRecipes' => Recipe::where('status', 'pending')->count(),
                'totalCategories' => Category::count(),
            ],
            'recentRecipes' => Recipe::with(['category', 'user'])
                ->latest()
                ->take(5)
                ->get()
                ->map(fn ($r) => [
                    'id' => $r->id,
                    'title' => $r->title,
                    'status' => $r->status,
                    'author_name' => $r->author_name,
                    'user' => $r->user ? ['name' => $r->user->name] : null,
                    'category' => $r->category ? ['name' => $r->category->name] : null,
                    'created_at' => $r->created_at->diffForHumans(),
                ]),
        ]);
    }
}
