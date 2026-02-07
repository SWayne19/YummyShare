<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseTypeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecipeController;
use App\Models\Center;
use App\Models\Course;
use App\Models\CourseType;
use Illuminate\Support\Facades\Route;

// home
Route::get('/',[HomeController::class,'index'])->name('home');

// about us
Route::get('/aboutus', function () {
    return inertia('AboutUs');
});

// recipes
Route::resource('recipes', RecipeController::class)
    ->only([
        'index',
        'show',
        'create',
        'store',
    ]);
