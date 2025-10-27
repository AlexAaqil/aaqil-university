<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use App\Models\Courses\Course;
use App\Models\Courses\Specialization;
use App\Http\Requests\Courses\SpecializationRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SpecializationController extends Controller
{
    public function create(Course $course)
    {
        $courses = Course::orderBy('title')->get();

        return view('pages.courses.specializations.create', compact('course', 'courses'));
    }

    public function store(SpecializationRequest $request, Course $course)
    {
        $validated_data = $request->validated();

        $specialization = $course->specializations()->create([
            'title' => $validated_data['title'],
            'description' => $validated_data['description'] ?? null,
            'image' => $validated_data['image'] ?? null,
            'is_published' => $validated_data['is_published'] ?? true,
            'sort_order' => $validated_data['sort_order'] ?? null,
        ]);

        return redirect()
            ->route('admin.course.specializations.index', $course)
            ->with('success', 'Specialization created successfully.');
    }

    public function edit(Course $course, Specialization $specialization)
    {
        if ($specialization->course_id !== $course->id) {
            abort(404);
        }

        $courses = Course::orderBy('title')->get();

        return view('pages.courses.specializations.edit', compact('course', 'specialization', 'courses'));
    }

    public function update(SpecializationRequest $request, Course $course, Specialization $specialization)
    {
        if ($specialization->course_id !== $course->id) {
            abort(404);
        }

        $validated_data = $request->validated();

        if ($request->has('remove_image') && $specialization->image) {
            if (Storage::disk('public')->exists('courses/specializations/' . $specialization->image)) {
                Storage::disk('public')->delete('courses/specializations/' . $specialization->image);
            }
            $validated_data['image'] = null;
        } elseif ($request->hasFile('image')) {
            if ($specialization->image && Storage::disk('public')->exists('courses/specializations/' . $specialization->image)) {
                Storage::disk('public')->delete('courses/specializations/' . $specialization->image);
            }

            $image = $request->file('image');
            $image_name = Str::slug($validated_data['title']). '-' . time() . Str::random(5) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('courses/specializations/', $image_name, 'public');
            $validated_data['image'] = $image_name;
        } else {
            $validated_data['image'] = $specialization->image;
        }

        $specialization->update($validated_data);

        $updated_course = Course::find($validated_data['course_id']);

        return redirect()
            ->route('admin.course.specializations.index', $updated_course->slug)
            ->with('success', 'Specialization updated successfully.');
    }
}