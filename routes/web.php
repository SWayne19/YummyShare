<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RecipeController as AdminRecipeController;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/aboutus', fn () => inertia('AboutUs'));
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');

// Authenticated (must be before /recipes/{recipe} to avoid route conflict)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
});

// Public recipe show (after /recipes/create)
Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');

// Guest only
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/recipes', [AdminRecipeController::class, 'index'])->name('recipes.index');
    Route::post('/recipes/{recipe}/approve', [AdminRecipeController::class, 'approve'])->name('recipes.approve');
    Route::post('/recipes/{recipe}/reject', [AdminRecipeController::class, 'reject'])->name('recipes.reject');
    Route::delete('/recipes/{recipe}', [AdminRecipeController::class, 'destroy'])->name('recipes.destroy');
});
