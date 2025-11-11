<x-app-layout>
    <div class="Courses TopicLessons">
        <div class="custom_form">
            <div class="header">
                <a href="{{ Route::has('admin.topic.lessons.index') ? route('admin.topic.lessons.index', [$topic->specialization->course->slug, $topic->specialization->slug, $topic->slug]) : '#' }}">
                    <x-svgs.arrow-left class="w-5 h-5" />
                </a>
                <h1>Update {{ $topic->title }} Lesson</h1>
            </div>

            <form action="{{ route('admin.topic.lessons.update', [$topic->specialization->course->slug, $topic->specialization->slug, $topic->slug, $lesson->uuid]) }}" method="post">
                @csrf
                @method('PATCH')

                <input type="hidden" name="sort_order" id="sort_order" value="{{ $lesson->ordering }}">
                <input type="hidden" name="topic_id" id="topic_id" value="{{ $topic->id }}">

                <div class="inputs">
                    <label for="title">Lesson Title</label>
                    <input type="text" name="title" id="title" placeholder="Lesson Title" value="{{ old('title', $lesson->title) }}">
                    <x-form-input-error field="title" />
                </div>

                <button type="submit">Update</button>
            </form>
        </div>
    </div>
</x-app-layout>
