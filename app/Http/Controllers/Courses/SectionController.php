<?php

namespace App\Http\Controllers\courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\SectionRequest;
use Illuminate\Http\Request;
use App\Models\Courses\Lesson;
use App\Models\Courses\Section;

class SectionController extends Controller
{
    public function create($lesson)
    {
        $lesson = Lesson::findOrFail($lesson);

        return view('pages.courses.sections.create', compact('lesson'));
    }

    public function store(SectionRequest $request)
    {
        $validated_data = $request->validated();

        $section = Section::create($validated_data);

        $lesson = Lesson::findOrFail($section->lesson_id);

        return redirect()->route('lesson-sections.index', $lesson->slug)->with('success', 'Section created successfully.');
    }

    public function edit(Section $section, $lesson)
    {
        $lesson = Lesson::where('slug', $lesson)->firstOrFail();

        return view('pages.courses.sections.edit', compact('lesson', 'section'));
    }

    public function update(SectionRequest $request, Section $section, $lesson)
    {
        $validated_data = $request->validated();

        $section->update($validated_data);

        $lesson = Lesson::where('slug', $lesson)->firstOrFail();

        return redirect()->route('lesson-sections.index', $lesson->slug)->with('success', 'Section updated successfully.');
    }
}
