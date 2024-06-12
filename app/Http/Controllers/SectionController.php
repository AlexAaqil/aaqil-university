<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Lesson;
use Illuminate\Support\Str;

class SectionController extends Controller
{
    public function index($lesson)
    {
        $lesson = Lesson::where('slug', $lesson)->with('sections')->firstOrFail();

        return view('admin.sections.index', compact('lesson'));
    }

    public function create()
    {
        $lessons = Lesson::orderBy('title')->get();

        return view('admin.sections.create', compact('lessons'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'lesson_id' => 'required|numeric',
            'ordering' => 'required|numeric',
            'content' => 'required',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        Section::create($validated);

        $lesson = Lesson::findOrFail($validated['lesson_id']);

        return redirect()->route('sections.index', $lesson->slug)->with('success', ['message' => 'Section has been added']);
    }

    public function edit(Section $section)
    {
        $specializationId = $section->lesson->topic->specialization_id;

        $lessons = Lesson::whereHas('topic', function($query) use ($specializationId) {
            $query->where('specialization_id', $specializationId);
        })->orderBy('title')->get();

        return view('admin.sections.edit', compact('section', 'lessons'));
    }

    public function update(Request $request, Section $section)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'lesson_id' => 'required|numeric',
            'ordering' => 'required|numeric',
            'content' => 'required',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $section->update($validated);

        $lesson = Lesson::findOrFail($validated['lesson_id']);

        return redirect()->route('sections.index', $lesson->slug)->with('success', ['message' => 'Section has been updated']);
    }

    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()->route('sections.index', $section->lesson->slug)->with('success', ['message' => 'Section has been deleted']);
    }
}
