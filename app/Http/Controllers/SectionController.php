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
        $lesson = Lesson::with('sections')->findOrFail($lesson);

        return view('admin.sections.index', compact('lesson'));
    }

    public function create($lesson)
    {
        $lesson = Lesson::with('topic')->where('id', $lesson)->firstOrFail();

        return view('admin.sections.create', compact('lesson'));
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

        return redirect()->route('sections.index', $validated['lesson_id'])->with('success', ['message' => 'Section has been added']);
    }

    public function edit(Section $section, $lesson)
    {
        $lesson = Lesson::findOrFail($lesson);

        return view('admin.sections.edit', compact('lesson', 'section'));
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

        return redirect()->route('sections.index', $validated['lesson_id'])->with('success', ['message' => 'Section has been updated']);
    }

    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()->route('sections.index', $section->lesson->id)->with('success', ['message' => 'Section has been deleted']);
    }
}
