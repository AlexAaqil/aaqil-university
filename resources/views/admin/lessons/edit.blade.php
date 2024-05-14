<x-admin-layout class="Course">
    <div class="custom_form">
        <div class="header">
            <h1>Update Lesson</h1>
        </div>

        <form action="{{ route('lessons.update', $lesson->id) }}" method="post">
            @csrf
            @method('PATCH')

            <div class="row_input_group">
                <div class="input_group">
                    <label for="title">Lesson Title</label>
                    <input type="text" name="title" id="title" placeholder="Topic Title" value="{{ old('title', $lesson->title) }}">
                    <span class="inline_alert">{{ $errors->first('title') }}</span>
                </div>
    
                <div class="input_group">
                    <label for="ordering">Ordering</label>
                    <input type="number" name="ordering" id="ordering" placeholder="Ordering" value="{{ old('ordering', $lesson->ordering) }}">
                    <span class="inline_alert">{{ $errors->first('ordering') }}</span>
                </div>
            </div>

            <div class="input_group">
                <label for="topic_id">Topic</label>
                <select name="topic_id" id="topic_id">
                    <option value="">Select Topic</option>
                    @foreach($topics as $topic)
                        <option value="{{ $topic->id }}" {{ old('topic_id', $lesson->topic_id) == $topic->id ? 'selected' : '' }}>{{ $topic->title }}</option>
                    @endforeach
                </select>
                <span class="inline_alert">{{ $errors->first('topic_id') }}</span>
            </div>            

            <button type="submit">Update</button>
        </form>
    </div>
</x-admin-layout>