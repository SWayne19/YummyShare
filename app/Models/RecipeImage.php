<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeImage extends Model
{
    protected $fillable = ['image_path', 'is_main'];
}
