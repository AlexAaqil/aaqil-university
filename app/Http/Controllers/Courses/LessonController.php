<?php

namespace App\Http\Controllers\courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\LessonRequest;
use App\Models\Courses\Lesson;
use Illuminate\Http\Request;
use App\Models\Courses\Topic;

class LessonController extends Controller
{
    public function create($topic)
    {
        $topic = Topic::where('slug', $topic)->firstOrFail();

        return view('pages.courses.lessons.create', compact('topic'));
    }

    public function store(LessonRequest $request)
    {
        $validated_data = $request->validated();

        $lesson = Lesson::create($validated_data);

        $topic = Topic::findOrFail($lesson->topic_id);

        return redirect()->route('topic-lessons.index', $topic->slug)->with('success', 'Lesson created successfully.');
    }

    public function edit(Lesson $lesson, $topic)
    {
        $topic = Topic::where('slug', $topic)->firstOrFail();

        return view('pages.courses.lessons.edit', compact('lesson', 'topic'));
    }

    public function update(LessonRequest $request, Lesson $lesson, $topic)
    {
        $validated_data = $request->validated();

        $lesson->update($validated_data);

        $topic = Topic::where('slug', $topic)->firstOrFail();

        return redirect()->route('topic-lessons.index', $topic->slug)->with('success', 'Lesson updated successfully.');
    }
}
