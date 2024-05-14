<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Specialization;

class GeneralPagesController extends Controller
{
    public function home()
    {
        return view("index");
    }

    public function about()
    {
        $users = User::where('user_level', 2)->get();
        return view("about", compact('users'));
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

    public function specialization_topics($specialization)
    {
        $specialization = Specialization::where('slug', $specialization)->with('topics')->firstOrFail();

        return view("specialization_topics", compact('specialization'));
    }

    public function contact()
    {
        return view("contact");
    }
}
