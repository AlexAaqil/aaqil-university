<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('title')->get();

        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:200|unique:courses',
            'description' => 'required|string|max:255',
            'thumbnail' => 'max:2048',
        ]);

        $course = new Course;

        $course->title = $request->title;
        $course->slug = Str::slug($request->title);
        $course->description = $request->description;
        $course->visibility = $request->visibility;

        if($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $filename = Str::slug($request->title) . '-aaqil-university' . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail = $thumbnail->storeAs('course_thumbnails', $filename, 'public');
            $course->thumbnail = $filename;
        }

        $course->save();

        return redirect()->route('courses.index')->with('success', ['message' => 'Course has been created']);
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:200|unique:courses,title,' . $course->id,
            'description' => 'required|string|max:200',
            'thumbnail' => 'max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            // Delete the old thumbnail file
            Storage::delete('public/course_thumbnails/' . $course->thumbnail);
    
            // Upload the new thumbnail file
            $thumbnail = $request->file('thumbnail');
            $filename = Str::slug($request->title) . '-aaqil-university' . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail = $thumbnail->storeAs('course_thumbnails', $filename, 'public');
            $course->thumbnail = $filename;
        }

        // Check if the title has changed
        if ($request->title !== $course->title) {
            $course->title = $request->title;
            $course->slug = Str::slug($request->title);

            // Check if the course has a thumbnail
            if ($course->thumbnail) {
                // Get the current filename
                $oldFilename = $course->thumbnail;

                // Generate the new filename based on the updated title
                $newFilename = Str::slug($request->title) . '-aaqil-university' . '.' . pathinfo($oldFilename, PATHINFO_EXTENSION);

                // Rename the file in storage
                Storage::move('public/course_thumbnails/' . $oldFilename, 'public/course_thumbnails/' . $newFilename);

                // Update the course thumbnail to the new filename
                $course->thumbnail = $newFilename;
            }
        }

        $course->description = $request->description;
        $course->visibility = $request->visibility;

        $course->save();

        return redirect()->route('courses.index')->with('success', ['message' => 'Course has been updated']);
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')->with('success', ['message' => 'Course has been deleted']);
    }
}
