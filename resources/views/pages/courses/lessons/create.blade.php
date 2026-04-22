<x-app-layout>
    <div class="Courses TopicLessons">
        <div class="custom_form">
            <div class="header">
                <a href="{{ Route::has('admin.topic.lessons.index') ? route('admin.topic.lessons.index', [$topic->specialization->course->slug, $topic->specialization->slug, $topic->slug]) : '#' }}">
                    <x-svgs.arrow-left class="w-5 h-5" />
                </a>
                <h1>New {{ $topic->title }} Lesson</h1>
            </div>

            <form action="{{ route('admin.topic.lessons.store', [$topic->specialization->course->slug, $topic->specialization->slug, $topic->slug]) }}" method="post">
                @csrf

                <input type="hidden" name="topic_id" id="topic_id" value="{{ $topic->id }}">

                <div class="inputs">
                    <label for="title">Lesson Title</label>
                    <input type="text" name="title" id="title" placeholder="Topic Title" value="{{ old('title') }}" autofocus>
                    <x-form-input-error field="title" />
                </div>

                <div class="inputs">
                    <label for="sort_order">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" placeholder="Ordering" value="{{ old('sort_order', 100) }}">
                    <x-form-input-error field="sort_order" />
                </div>

                <button type="submit">Save</button>
            </form>
        </div>
    </div>
</x-app-layout>
