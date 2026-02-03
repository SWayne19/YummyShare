<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class RecipeController extends Controller
{
    public function index()
    {
        return Inertia::render('Recipes/Index');
    }
    public function create()
    {
        return Inertia::render('Recipes/Form');
    }
}
