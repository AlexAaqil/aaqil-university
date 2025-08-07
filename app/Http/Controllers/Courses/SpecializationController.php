<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courses\Course;
use App\Models\Courses\Specialization;
use App\Http\Requests\Courses\SpecializationRequest;

class SpecializationController extends Controller
{
    public function create($course)
    {
        $course = Course::findOrFail($course);
        $courses = Course::orderBy('title')->get();

        return view('pages.courses.specializations.create', compact('course', 'courses'));
    }

    public function store(SpecializationRequest $request)
    {
        $validated = $request->validated();

        $specialization = Specialization::create([
            'title' => $validated['title'],
        ]);

        foreach ($validated['courses'] as $courseId) {
            $specialization->courses()->attach($courseId, [
                'sort_order' => $validated['sort_order'][$courseId] ?? null,
            ]);
        }

        $course = Course::findOrFail($validated['courses'][0]);

        return redirect()
            ->route('course-specializations.index', $course->slug)
            ->with('success', 'Specialization created successfully.');
    }

    public function edit($id)
    {
        $specialization = Specialization::with('courses')->findOrFail($id);
        $courses = Course::orderBy('title')->get();

        // get sort orders from pivot
        $courseSortOrders = $specialization->courses->pluck('pivot.sort_order', 'id')->toArray();

        return view('pages.courses.specializations.edit', compact('specialization', 'courses', 'courseSortOrders'));
    }

    public function update(SpecializationRequest $request, $id)
    {
        $validated = $request->validated();

        $specialization = Specialization::findOrFail($id);

        $specialization->update([
            'title' => $validated['title'],
        ]);

        $syncData = [];
        foreach ($validated['courses'] as $courseId) {
            $syncData[$courseId] = [
                'sort_order' => $validated['sort_order'][$courseId] ?? null,
            ];
        }

        $specialization->courses()->sync($syncData);

        return redirect()
            ->route('course-specializations.index', $validated['courses'][0])
            ->with('success', 'Specialization updated successfully.');
    }
}
