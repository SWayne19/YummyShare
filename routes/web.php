<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

// home
Route::get('/',function(){
    return inertia('Index');
});

// article
Route::resource('articles', ArticleController::class);

// about
Route::get('/about', function(){
    return inertia('About');
});

// content
Route::get('/content', function(){
    return inertia('Content');
});
