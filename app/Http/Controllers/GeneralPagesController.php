<?php

namespace App\Http\Controllers;

use App\Models\Course;

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

    public function contact()
    {
        return view("contact");
    }
}
