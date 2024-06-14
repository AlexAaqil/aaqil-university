<x-admin-layout class="Course">
    <div class="custom_form">
        <div class="header">
            <h1>Update {{ $topic->title }} Lesson</h1>
        </div>

        <form action="{{ route('lessons.update', $lesson->id) }}" method="post">
            @csrf
            @method('PATCH')

            <input type="hidden" name="ordering" id="ordering" value="{{ $lesson->ordering }}">
            <input type="hidden" name="topic_id" id="topic_id" value="{{ $topic->id }}">

            <div class="input_group">
                <label for="title">Lesson Title</label>
                <input type="text" name="title" id="title" placeholder="Topic Title" value="{{ old('title', $lesson->title) }}">
                <span class="inline_alert">{{ $errors->first('title') }}</span>
            </div>

            <button type="submit">Update</button>
        </form>
    </div>
</x-admin-layout>