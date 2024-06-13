<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Specialization;
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
        $specialization = Specialization::with('courses')->where('id', $specialization)->firstOrFail();

        return view('admin.specialization_topics.create', compact('specialization'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:topics',
            'ordering' => 'required|numeric',
            'specialization_id' => 'numeric|exists:specializations,id',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        Topic::create($validated);

        return redirect()->route('topics.index', $validated['specialization_id'])->with('success', ['message' => 'Specialization topic has been added']);
    }

    public function edit(Topic $topic, $specialization)
    {
        $specialization = Specialization::findOrFail($specialization);

        return view('admin.specialization_topics.edit', compact('specialization', 'topic'));
    }

    public function update(Request $request, Topic $topic)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:topics,title,' . $topic->id,
            'ordering' => 'required|numeric',
            'specialization_id' => 'numeric|exists:specializations,id',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $topic->update($validated);

        return redirect()->route('topics.index', $validated['specialization_id'])->with('success', ['message' => 'Specialization Topic has been updated']);
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();

        return redirect()->route('topics.index', $topic->specialization->id)->with('success', ['message' => 'Specialization topic has been deleted']);
    }

    public function sort_topics(Request $request)
    {
        return $this->sort_items($request, Topic::class);
    }
}
