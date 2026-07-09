<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Recipe extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'author_name',
        'cook_time',
        'servings',
        'difficulty',
        'instructions',
        'is_published',
        'status',
    ];

    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', 'approved');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
