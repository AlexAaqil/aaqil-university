<?php

namespace App\Http\Controllers\courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courses\Specialization;
use App\Models\Courses\Topic;
use App\Http\Requests\Courses\TopicRequest;

class TopicController extends Controller
{
    public function create($specialization)
    {
        $specialization = Specialization::findOrFail($specialization);

        return view('pages.courses.topics.create', compact('specialization'));
    }

    public function store(TopicRequest $request)
    {
        $validated_data = $request->validated();

        $topic = Topic::create($validated_data);

        $specialization = Specialization::findOrFail($topic->specialization_id);

        return redirect()->route('specialization-topics.index', $specialization->slug)
            ->with('success', 'Topic created successfully.');
    }

    public function edit(Topic $topic, $specialization)
    {
        $specialization = Specialization::where('slug', $specialization)->firstOrFail();

        return view('pages.courses.topics.edit', compact('topic', 'specialization'));
    }

    public function update(TopicRequest $request, Topic $topic, $specialization)
    {
        $validated_data = $request->validated();

        $topic->update($validated_data);

        $specialization = Specialization::where('slug', $specialization)->firstOrFail();

        return redirect()->route('specialization-topics.index', $specialization->slug)
            ->with('success', 'Topic updated successfully.');
    }
}
