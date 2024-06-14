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
        $topic = Topic::with('lessons')->findOrFail($topic);

        return view('admin.lessons.index', compact('topic'));
    }

    public function create($topic)
    {
        $topic = Topic::with('specialization')->where('id', $topic)->firstOrFail();

        return view('admin.lessons.create', compact('topic'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:lessons,title',
            'ordering' => 'required|numeric',
            'topic_id' => 'required|numeric',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        Lesson::create($validated);

        return redirect()->route('lessons.index', $validated['topic_id'])->with('success', ['message' => 'Lesson has been added']);
    }

    public function edit(Lesson $lesson, $topic)
    {
        $topic = Topic::findOrFail($topic);

        return view('admin.lessons.edit', compact('lesson', 'topic'));
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

        return redirect()->route('lessons.index', $validated['topic_id'])->with('success', ['message' => 'Lesson has been updated']);
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return redirect()->route('lessons.index', $lesson->topic->id)->with('success', ['message' => 'Lesson has been deleted']);
    }

    public function sort_lessons(Request $request)
    {
        return $this->sort_items($request, Lesson::class);
    }
}
