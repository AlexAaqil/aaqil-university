<x-admin-layout class="Course_categories">
    <div class="custom_form">
        <div class="header">
            <h1>Update Course Category</h1>
        </div>

        <form action="{{ route('course-categories.update', ['course_category' => $course_category->id]) }}" method="post">
            @csrf
            @method('PATCH')

            <div class="input_group">
                <label for="title">Course Category</label>
                <input type="text" name="title" id="title" value="{{ old('title', $course_category->title) }}">
                <span class="inline_alert">{{ $errors->first('title') }}</span>
            </div>

            <button type="submit">Update</button>
        </form>
    </div>
</x-admin-layout>