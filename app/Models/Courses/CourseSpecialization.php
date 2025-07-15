<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;

class CourseSpecialization extends Model
{
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
