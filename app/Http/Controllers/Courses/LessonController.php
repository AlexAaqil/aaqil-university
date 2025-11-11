<?php

namespace App\Http\Controllers\courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\LessonRequest;
use App\Models\Courses\Lesson;
use Illuminate\Http\Request;
use App\Models\Courses\Topic;

class LessonController extends Controller
{
    public function create($course, $specialization, $topic)
    {
        $topic = Topic::where('slug', $topic)
            ->whereHas('specialization', function ($query) use ($specialization, $course) {
                $query->where('slug', $specialization)
                      ->whereHas('course', function ($query) use ($course) {
                          $query->where('slug', $course);
                      });
            })
            ->with(['specialization.course'])
            ->firstOrFail();

        return view('pages.courses.lessons.create', compact('topic'));
    }

    public function store(LessonRequest $request, $course, $specialization, $topic)
    {
        $topic = Topic::where('slug', $topic)
            ->whereHas('specialization', function ($q) use ($specialization, $course) {
                $q->where('slug', $specialization)
                  ->whereHas('course', function ($q) use ($course) {
                      $q->where('slug', $course);
                  });
            })
            ->firstOrFail();
        
        $validated_data = $request->validated();
        $validated_data['topic_id'] = $topic->id;

        $lesson = Lesson::create($validated_data);

        $topic = Topic::findOrFail($lesson->topic_id);

        return redirect()->route('admin.topic.lessons.index', [$topic->specialization->course->slug, $topic->specialization->slug, $topic->slug])->with('success', 'Lesson created successfully.');
    }

    public function edit($course, $specialization, $topic, Lesson $lesson)
    {
        $topic = Topic::where('slug', $topic)
            ->whereHas('specialization', function ($q) use ($specialization, $course) {
                $q->where('slug', $specialization)
                  ->whereHas('course', function ($q) use ($course) {
                      $q->where('slug', $course);
                  });
            })
            ->with(['specialization.course'])
            ->firstOrFail();

        return view('pages.courses.lessons.edit', compact('lesson', 'topic'));
    }

    public function update(LessonRequest $request, $course, $specialization, $topic, Lesson $lesson)
    {
        $validated_data = $request->validated();

        $lesson->update($validated_data);

        // Resolve the topic scoped to the given specialization and course slugs so we
        // always redirect to the lessons list for the correct parent.
        $specializationModel = \App\Models\Courses\Specialization::where('slug', $specialization)
            ->whereHas('course', function ($q) use ($course) {
                $q->where('slug', $course);
            })
            ->firstOrFail();

        $topicModel = $specializationModel->topics()->where('slug', $topic)->with(['specialization.course'])->firstOrFail();

        return redirect()->route('admin.topic.lessons.index', [$topicModel->specialization->course->slug, $topicModel->specialization->slug, $topicModel->slug])->with('success', 'Lesson updated successfully.');
    }
}
