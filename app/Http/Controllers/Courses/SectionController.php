<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\SectionRequest;
use Illuminate\Http\Request;
use App\Models\Courses\Lesson;
use App\Models\Courses\Section;

class SectionController extends Controller
{
    public function create($course, $specialization, $topic, $lesson)
    {
        $lesson = Lesson::where('slug', $lesson)
            ->whereHas('topic', function ($q) use ($topic, $specialization, $course) {
                $q->where('slug', $topic)
                  ->whereHas('specialization', function ($q2) use ($specialization, $course) {
                      $q2->where('slug', $specialization)
                         ->whereHas('course', function ($q3) use ($course) {
                             $q3->where('slug', $course);
                         });
                  });
            })
            ->with(['topic.specialization.course'])
            ->firstOrFail();

        return view('pages.courses.sections.create', compact('lesson'));
    }

    public function store(SectionRequest $request, $course, $specialization, $topic, $lesson)
    {
        $lesson = Lesson::where('slug', $lesson)
            ->whereHas('topic', function ($q) use ($topic, $specialization, $course) {
                $q->where('slug', $topic)
                  ->whereHas('specialization', function ($q2) use ($specialization, $course) {
                      $q2->where('slug', $specialization)
                         ->whereHas('course', function ($q3) use ($course) {
                             $q3->where('slug', $course);
                         });
                  });
            })
            ->firstOrFail();

        $validated_data = $request->validated();
        $validated_data['lesson_id'] = $lesson->id;

        $section = Section::create($validated_data);

        return redirect()->route('admin.lesson.sections.index', [$course, $specialization, $topic, $lesson->slug])->with('success', 'Section created successfully.');
    }

    public function edit($course, $specialization, $topic, $lesson, Section $section)
    {
        $lesson = Lesson::where('slug', $lesson)
            ->whereHas('topic', function ($q) use ($topic, $specialization, $course) {
                $q->where('slug', $topic)
                  ->whereHas('specialization', function ($q2) use ($specialization, $course) {
                      $q2->where('slug', $specialization)
                         ->whereHas('course', function ($q3) use ($course) {
                             $q3->where('slug', $course);
                         });
                  });
            })
            ->firstOrFail();

        return view('pages.courses.sections.edit', compact('lesson', 'section'));
    }

    public function update(SectionRequest $request, $course, $specialization, $topic, $lesson, Section $section)
    {
        $validated_data = $request->validated();

        $section->update($validated_data);

        return redirect()->route('admin.lesson.sections.index', [$course, $specialization, $topic, $lesson])->with('success', 'Section updated successfully.');
    }
}
