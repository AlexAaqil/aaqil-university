<x-admin-layout class="Course">
    <div class="custom_form">
        <div class="header">
            <h1>New {{ $lesson->title }} Section</h1>
        </div>

        <form action="{{ route('sections.store') }}" method="post">
            @csrf

            <input type="hidden" name="ordering" id="ordering" value="500">
            <input type="hidden" name="lesson_id" id="lesson_id" value="{{ $lesson->id }}">

            <div class="input_group">
                <label for="title">Section Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}">
                <span class="inline_alert">{{ $errors->first('title') }}</span>
            </div>           

            <div class="input_group">
                <label for="content">Section Content</label>
                <textarea name="content" id="editor_ckeditor" cols="30" rows="10" placehoder="Enter the section content">{{ old('content') }}</textarea>
                <span class="inline_alert">{{ $errors->first('content') }}</span>
            </div>

            <button type="submit">Save</button>
        </form>
    </div>

    <x-ckeditor />
</x-admin-layout>