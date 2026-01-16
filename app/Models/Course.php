<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'course_type_id',
        'name',
        'code',
        'duration',
        'status'
    ];

    public function courseType()
    {
        return $this->belongsTo(CourseType::class);
    }
}
