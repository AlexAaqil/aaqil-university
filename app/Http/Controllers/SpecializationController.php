<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Models\Course;
use Illuminate\Support\Str;

class SpecializationController extends Controller
{
    public function index($course)
    {
        $course = Course::where('slug', $course)->with('specializations')->firstOrFail();

        return view('admin.course_specializations.index', compact('course'));
    }

    public function create()
    {
        $courses = Course::orderBy('title')->get();

        return view('admin.course_specializations.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|unique:specializations',
            'courses' => 'required|array',
            'courses.*' => 'exists:courses,id',
            'orderings' => 'required|array',
            'orderings.*' => 'required|numeric|min:1',
        ]);
    
        $specialization = Specialization::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
        ]);
    
        // Attach courses to the specialization with orderings
        if (isset($validated['courses']) && is_array($validated['courses'])) {
            foreach ($validated['courses'] as $courseId) {
                $attributes = [];
                if (isset($validated['orderings'][$courseId])) {
                    $attributes['ordering'] = $validated['orderings'][$courseId];
                }
                $specialization->courses()->attach($courseId, $attributes);
            }
        }
    
        return redirect()->route('courses.index')->with('success', 'Course Specialization has been added');
    }

    public function edit(Specialization $course_specialization)
    {
        $courses = Course::orderBy('title')->get();

        return view('admin.course_specializations.edit', compact('courses', 'course_specialization'));
    }

    public function update(Request $request, Specialization $course_specialization)
    {
        $validated = $request->validate([
            'title' => 'required|string|unique:specializations,title,' . $course_specialization->id,
            'courses' => 'required|array',
            'courses.*' => 'exists:courses,id',
            'orderings' => 'required|array',
            'orderings.*' => 'required|numeric|min:1',
        ]);

        $course_specialization->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
        ]);

        // Sync courses with orderings if both arrays are not empty
        if (!empty($validated['courses']) && !empty($validated['orderings'])) {
            $coursesData = [];
            foreach ($validated['courses'] as $index => $courseId) {
                // Ensure the index exists in the orderings array before accessing it
                $ordering = isset($validated['orderings'][$index]) ? $validated['orderings'][$index] : 500;
                $coursesData[$courseId] = ['ordering' => $ordering];
            }
        
            $course_specialization->courses()->sync($coursesData);
        }

        return redirect()->route('courses.index')->with('success', ['message' => 'Course Specialization has been updated']);
    }

    public function destroy(Specialization $course_specialization)
    {
        $course_specialization->delete();

        return redirect()->back()->with('success', ['message' => 'Course Specialization has been deleted']);
    }
}
