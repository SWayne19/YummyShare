<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::withCount('recipes')->latest();

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        return Inertia::render('Admin/Categories', [
            'categories' => $query->paginate(15)->withQueryString(),
            'filters' => $request->only(['search']),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string|max:500',
            'image' => 'required|string|max:500',
        ]);

        Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? '',
            'image' => $validated['image'],
        ]);

        return back()->with('success', 'Category created successfully.');
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:500',
            'image' => 'required|string|max:500',
        ]);

        $category->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? '',
            'image' => $validated['image'],
        ]);

        return back()->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->recipes()->exists()) {
            return back()->with('error', 'Cannot delete category with existing recipes. Reassign recipes first.');
        }

        $category->delete();

        return back()->with('success', 'Category deleted successfully.');
    }
}
