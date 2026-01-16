<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseTypeController;
use App\Models\Center;
use App\Models\Course;
use App\Models\CourseType;
use Illuminate\Support\Facades\Route;

// home
Route::get('/', function () {
    return inertia('Index', [
        'totalCourseTypes' => CourseType::count(),
        'courses' => Course::count(),
    ]);
});

// article
// Route::resource('articles', ArticleController::class);

// center
Route::resource('centers',CenterController::class);

// course type
Route::resource('courseTypes', CourseTypeController::class);

// course
Route::resource('courses',CourseController::class);
