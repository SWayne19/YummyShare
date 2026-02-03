<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::select('name')->orderByDesc('id')->take(2)->get();
        return Inertia::render('Index', [
            'categories' => $categories
        ]);
    }
}
