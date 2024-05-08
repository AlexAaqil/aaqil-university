<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseSpecialization;

class GeneralPagesController extends Controller
{
    public function home()
    {
        return view("index");
    }

    public function about()
    {
        return view("about");
    }

    public function courses()
    {
        $courses = Course::orderBy('title')->where('visibility', 1)->get();
        
        return view("courses", compact('courses'));
    }

    public function course_specializations($slug)
    {
        $course = Course::where('slug', $slug)
        ->with(['specializations' => function($query) {
            $query->orderBy('ordering');
        }])
        ->firstOrFail();

        return view("course_specializations", compact('course'));
    }

    public function contact()
    {
        return view("contact");
    }
}
