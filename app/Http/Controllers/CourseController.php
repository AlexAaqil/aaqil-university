<?php

namespace App\Http\Controllers;

use App\Models\course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('ordering')->get();

        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200|unique:courses',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        Course::create($validated);

        return redirect()->route('course-categories.index')->with('success', ['message' => 'Course Category has been created']);
    }

    public function edit(Course $course_category)
    {
        return view('admin.courses.edit', compact('course_category'));
    }

    public function update(Request $request, Course $course_category)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200|unique:courses,title,' . $course_category->id,
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $course_category->update($validated);

        return redirect()->route('course-categories.index')->with('success', ['message' => 'Course Category has been updated']);
    }

    public function destroy(Course $course_category)
    {
        $course_category->delete();

        return redirect()->route('course-categories.index')->with('success', ['message' => 'Course Category has been deleted']);
    }
}
