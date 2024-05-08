<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseSpecialization;
use App\Models\Course;
use Illuminate\Support\Str;

class CourseSpecializationController extends Controller
{
    public function index()
    {
        $courses = Course::with(['specializations' => function($query) {
            $query->orderBy('ordering');
        }])
        ->orderBy('title')
        ->get();
        $course_specializations = CourseSpecialization::orderBy('title')->get();

        return view('admin.course_specializations.index', compact('courses', 'course_specializations'));
    }

    public function create()
    {
        $courses = Course::orderBy('title')->get();

        return view('admin.course_specializations.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|unique:course_specializations',
            'ordering' => 'required|numeric',
            'course_id' => 'required|numeric',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        CourseSpecialization::create($validated);

        return redirect()->route('course-specializations.index')->with('success', ['message' => 'Course Specialization has been added']);
    }

    public function edit(CourseSpecialization $course_specialization)
    {
        $courses = Course::orderBy('title')->get();

        return view('admin.course_specializations.edit', compact('courses', 'course_specialization'));
    }

    public function update(Request $request, CourseSpecialization $course_specialization)
    {
        $validated = $request->validate([
            'title' => 'required|string|unique:course_specializations,title,' . $course_specialization->id,
            'ordering' => 'required|numeric',
            'course_id' => 'required|numeric',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $course_specialization->update($validated);

        return redirect()->route('course-specializations.index')->with('success', ['message' => 'Course Specialization has been updated']);
    }

    public function destroy(CourseSpecialization $course_specialization)
    {
        $course_specialization->delete();

        return redirect()->route('course-specializations.index')->with('success', ['message' => 'Course Specialization has been deleted']);
    }
}
