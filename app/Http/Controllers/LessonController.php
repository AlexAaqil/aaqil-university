<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Topic;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    public function index($topic)
    {
        $topic = Topic::where('slug', $topic)
        ->with(['lessons' => function($query) {
            $query->orderBy('ordering');
        }])
        ->firstOrFail();

        return view('admin.lessons.index', compact('topic'));
    }

    public function create()
    {
        $topics = Topic::orderBy('title')->get();

        return view('admin.lessons.create', compact('topics'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'ordering' => 'required|numeric',
            'topic_id' => 'required|numeric',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        Lesson::create($validated);

        $topic = Topic::findOrFail($validated['topic_id']);

        return redirect()->route('lessons.index', $topic->slug)->with('success', ['message' => 'Lesson has been added']);
    }

    public function edit(Lesson $lesson)
    {
        $topics = Topic::orderBy('title')->get();

        return view('admin.lessons.edit', compact('lesson', 'topics'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'ordering' => 'required|numeric',
            'topic_id' => 'required|numeric',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $lesson->update($validated);

        $topic = Topic::findOrFail($validated['topic_id']);

        return redirect()->route('lessons.index', $topic->slug)->with('success', ['message' => 'Lesson has been updated']);
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return redirect()->route('lessons.index', $lesson->topic->slug)->with('success', ['message' => 'Lesson has been deleted']);
    }
}
