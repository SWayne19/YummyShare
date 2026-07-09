<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::with(['category', 'user', 'images'])->latest();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author_name', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        return Inertia::render('Admin/Recipes', [
            'recipes' => $query->paginate(15)->withQueryString(),
            'filters' => $request->only(['search', 'status']),
        ]);
    }

    public function approve(Recipe $recipe)
    {
        $recipe->update(['status' => 'approved']);

        return back()->with('success', "Recipe \"{$recipe->title}\" approved.");
    }

    public function reject(Recipe $recipe)
    {
        $recipe->update(['status' => 'rejected']);

        return back()->with('success', "Recipe \"{$recipe->title}\" rejected.");
    }

    public function destroy(Recipe $recipe)
    {
        // Delete associated images from storage
        foreach ($recipe->images as $image) {
            $path = str_replace('/storage/', '', $image->image_path);
            \Illuminate\Support\Facades\Storage::disk('public')->delete($path);
        }

        $recipe->delete();

        return back()->with('success', 'Recipe deleted successfully.');
    }
}
