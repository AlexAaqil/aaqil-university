<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSpecialization extends Model
{
    use HasFactory;

    protected $table = 'course_specialization';

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }
}
