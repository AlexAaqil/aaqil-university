<x-app-layout>
    <div class="Courses TopicLessons">
        <div class="custom_form">
            <div class="header">
                <a href="{{ Route::has('topic-lessons.index') ? route('topic-lessons.index', $topic->slug) : '#' }}">
                    <x-svgs.arrow-left class="w-5 h-5" />
                </a>
                <h1>New {{ $topic->title }} Lesson</h1>
            </div>

            <form action="{{ route('topic-lessons.store', $topic->slug) }}" method="post">
                @csrf

                <input type="hidden" name="sort_order" id="sort_order" value="100">
                <input type="hidden" name="topic_id" id="topic_id" value="{{ $topic->id }}">

                <div class="inputs">
                    <label for="title">Lesson Title</label>
                    <input type="text" name="title" id="title" placeholder="Topic Title" value="{{ old('title') }}">
                    <x-form-input-error field="title" />
                </div>

                <button type="submit">Save</button>
            </form>
        </div>
    </div>
</x-app-layout>
