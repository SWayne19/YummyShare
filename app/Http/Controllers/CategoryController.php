<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    // app/Http/Controllers/CategoryController.php

    public function index()
    {
        $categories = Category::select('id', 'name', 'slug', 'image', 'description')->get();

        return Inertia::render('Categories/Index', [
            'categories' => $categories
        ]);
    }
}
