<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Inertia;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::with(['category', 'images'])->latest()->get();
        return Inertia::render('Recipes/Index', [
            'recipes' => $recipes
        ]);
    }
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return Inertia::render('Recipes/Form', [
            'categories' => $categories
        ]);
    }

    public function show()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'cook_time' => 'required|integer|min:1',
            'servings' => 'required|integer|min:1',
            'difficulty' => 'required|in:easy,medium,hard',
            'instructions' => 'required|string',

            // Validate Array of Ingredients
            'ingredients' => 'required|array|min:1',
            'ingredients.*.name' => 'required|string|max:255',
            'ingredients.*.quantity' => 'nullable|string|max:50',
            'ingredients.*.unit' => 'nullable|string|max:50',

            // Validate Images
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        try {
            DB::transaction(function () use ($validated, $request) {

                // 1. Create the Recipe
                $recipe = Recipe::create([
                    'category_id' => $validated['category_id'],
                    'title' => $validated['title'],
                    'slug' => Str::slug($validated['title']) . '-' . uniqid(), 
                    'author_name' => $validated['author_name'],
                    'cook_time' => $validated['cook_time'],
                    'servings' => $validated['servings'],
                    'difficulty' => $validated['difficulty'],
                    'instructions' => $validated['instructions'],
                ]);

                // 2. Handle Ingredients (FirstOrCreate logic)
                foreach ($validated['ingredients'] as $ing) {
                    // Find existing ingredient or create new one
                    $ingredient = Ingredient::firstOrCreate(
                        ['name' => strtolower(trim($ing['name']))]
                    );

                    // Attach to pivot table
                    $recipe->ingredients()->attach($ingredient->id, [
                        'quantity' => $ing['quantity'],
                        'unit' => $ing['unit']
                    ]);
                }

                // 3. Handle Images
                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $index => $file) {
                        $path = $file->store('recipes', 'public');

                        $recipe->images()->create([
                            'image_path' => '/storage/' . $path,
                            'is_main' => $index === 0 // First image is main
                        ]);
                    }
                }
            });

            return redirect()->route('recipes.index')->with('success', 'Recipe created successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create recipe: ' . $e->getMessage()]);
        }
    }
}
