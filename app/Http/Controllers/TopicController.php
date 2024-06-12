<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Specialization;
use App\Models\CourseSpecialization;
use Illuminate\Support\Str;

class TopicController extends Controller
{
    public function index($specialization)
    {
        $specialization = Specialization::with('topics')->findOrFail($specialization);
        
        return view('admin.specialization_topics.index', compact('specialization'));
    }

    public function create($specialization)
    {
        $specialization = CourseSpecialization::with('specialization')->where('specialization_id', $specialization)->firstOrFail();

        $specializations = Specialization::whereHas('courses', function($query) use ($specialization) {
            $query->where('course_id', $specialization->course_id);
        })->get();

        return view('admin.specialization_topics.create', compact('specialization', 'specializations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:topics',
            'ordering' => 'required|numeric',
            'specialization_id' => 'required|numeric',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        Topic::create($validated);

        $specialization = Specialization::findOrFail($validated['specialization_id']);

        return redirect()->route('topics.index', $specialization->slug)->with('success', ['message' => 'Specialization topic has been added']);
    }

    public function edit(Topic $topic)
    {
        $specializations = Specialization::orderBy('title')->get();

        return view('admin.specialization_topics.edit', compact('topic', 'specializations'));
    }

    public function update(Request $request, Topic $topic)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:topics,title,' . $topic->id,
            'ordering' => 'required|numeric',
            'specialization_id' => 'required|numeric',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $topic->update($validated);

        $specialization = Specialization::findOrFail($validated['specialization_id']);

        return redirect()->route('topics.index', $specialization->slug)->with('success', ['message' => 'Specialization Topic has been updated']);
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();

        return redirect()->route('topics.index', $topic->specialization->slug)->with('success', ['message' => 'Specialization topic has been deleted']);
    }
}
