<x-admin-layout class="Courses">
    <div class="custom_form">
        <div class="header">
            <h1>New Course</h1>
        </div>

        <form action="{{ route('course-categories.store') }}" method="post">
            @csrf

            <div class="input_group">
                <label for="title">Course Category</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}">
                <span class="inline_alert">{{ $errors->first('title') }}</span>
            </div>

            <button type="submit">Save</button>
        </form>
    </div>
</x-admin-layout>