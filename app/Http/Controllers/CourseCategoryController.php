<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseCategory;
use Illuminate\Support\Str;

class CourseCategoryController extends Controller
{
    public function index()
    {
        $course_categories = CourseCategory::orderByDesc('title')->get();

        return view('admin.course_categories.index', compact('course_categories'));
    }

    public function create()
    {
        return view('admin.course_categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200|unique:course_categories',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        CourseCategory::create($validated);

        return redirect()->route('course-categories.index')->with('success', ['message' => 'Course Category has been created']);
    }

    public function edit(CourseCategory $course_category)
    {
        return view('admin.course_categories.edit', compact('course_category'));
    }

    public function update(Request $request, CourseCategory $course_category)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200|unique:course_categories,title,' . $course_category->id,
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $course_category->update($validated);

        return redirect()->route('course-categories.index')->with('success', ['message' => 'Course Category has been updated']);
    }

    public function destroy(CourseCategory $course_category)
    {
        $course_category->delete();

        return redirect()->route('course-categories.index')->with('success', ['message' => 'Course Category has been deleted']);
    }
}
