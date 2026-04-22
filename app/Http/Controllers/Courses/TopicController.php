<?php

namespace App\Http\Controllers\courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courses\Course;
use App\Models\Courses\Specialization;
use App\Models\Courses\Topic;
use App\Http\Requests\Courses\TopicRequest;

class TopicController extends Controller
{
    public function create($course, $specialization)
    {
        $course = Course::where('slug', $course)->firstOrFail();
        $specialization = Specialization::where('slug', $specialization)->where('course_id', $course->id)->firstOrFail();

        return view('pages.courses.topics.create', compact('course', 'specialization'));
    }

    public function store(TopicRequest $request)
    {
        $validated_data = $request->validated();

        $topic = Topic::create($validated_data);

        $specialization = Specialization::findOrFail($topic->specialization_id);

        return redirect()->route('admin.specialization.topics.index', [$specialization->course->slug, $specialization->slug])
            ->with('success', 'Topic created successfully.');
    }

    public function edit($course, $specialization, Topic $topic)
    {
        $specialization = Specialization::where('slug', $specialization)
            ->whereHas('course', function ($q) use ($course) {
                $q->where('slug', $course);
            })
            ->firstOrFail();

        // Ensure the topic belongs to this specialization
        if ($topic->specialization_id !== $specialization->id) {
            abort(404);
        }

        return view('pages.courses.topics.edit', compact('topic', 'specialization'));
    }

    public function update(TopicRequest $request, $course, $specialization, Topic $topic)
    {
        $validated_data = $request->validated();

        $topic->update($validated_data);

        $specialization = Specialization::where('slug', $specialization)
            ->whereHas('course', function ($q) use ($course) {
                $q->where('slug', $course);
            })
            ->firstOrFail();

        return redirect()->route('admin.specialization.topics.index', [$specialization->course->slug, $specialization->slug])
            ->with('success', 'Topic updated successfully.');
    }
}
