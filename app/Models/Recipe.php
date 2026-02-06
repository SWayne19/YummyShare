<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'author_name',
        'cook_time',
        'servings',
        'difficulty',
        'instructions',
        'is_published'
    ];

    public function images()
    {
        return $this->hasMany(RecipeImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredients')
            ->withPivot('quantity', 'unit')
            ->withTimestamps();
    }
}
