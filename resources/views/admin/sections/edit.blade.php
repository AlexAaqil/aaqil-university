<x-admin-layout class="Course">
    <div class="custom_form">
        <div class="header">
            <h1>Update Section</h1>
        </div>

        <form action="{{ route('sections.update', $section->id) }}" method="post">
            @csrf
            @method('PATCH')

            <div class="row_input_group">
                <div class="input_group">
                    <label for="lesson_id">Lesson</label>
                    <select name="lesson_id" id="lesson_id">
                        <option value="">Select Lesson</option>
                        @foreach($lessons as $lesson)
                            <option value="{{ $lesson->id }}" {{ old('lesson_id', $section->lesson_id) == $lesson->id ? 'selected' : '' }}>{{ $lesson->title }}</option>
                        @endforeach
                    </select>
                    <span class="inline_alert">{{ $errors->first('lesson_id') }}</span>
                </div>            
    
                <div class="input_group">
                    <label for="ordering">Ordering</label>
                    <input type="number" name="ordering" id="ordering" placeholder="Ordering" value="{{ old('ordering', $section->ordering) }}">
                    <span class="inline_alert">{{ $errors->first('ordering') }}</span>
                </div>
            </div>

            <div class="input_group">
                <label for="content">Section Content</label>
                <textarea name="content" id="editor_ckeditor" cols="30" rows="10" placehoder="Enter the section content">{{ old('content', $section->content) }}</textarea>
                <span class="inline_alert">{{ $errors->first('content') }}</span>
            </div>


            <button type="submit">Update</button>
        </form>
    </div>

    <x-ckeditor />
</x-admin-layout>