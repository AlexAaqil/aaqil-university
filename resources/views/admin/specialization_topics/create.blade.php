<x-admin-layout class="Course_specializations">
    <div class="custom_form">
        <div class="header">
            <h1>New Course Specialization</h1>
        </div>

        <form action="{{ route('course-specializations.store') }}" method="post">
            @csrf

            <div class="row_input_group">
                <div class="input_group">
                    <label for="title">Specialization Title</label>
                    <input type="text" name="title" id="title" placeholder="Course Title" value="{{ old('title') }}">
                    <span class="inline_alert">{{ $errors->first('title') }}</span>
                </div>
    
                <div class="input_group">
                    <label for="ordering">Ordering</label>
                    <input type="number" name="ordering" id="ordering" placeholder="Ordering" value="{{ old('ordering', 500) }}">
                    <span class="inline_alert">{{ $errors->first('ordering') }}</span>
                </div>
            </div>

            <div class="input_group">
                <label for="course_id">Course</label>
                <select name="course_id" id="course_id">
                    <option value="">Select Course</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                    @endforeach
                </select>
                <span class="inline_alert">{{ $errors->first('course_id') }}</span>
            </div>            

            <button type="submit">Save</button>
        </form>
    </div>
</x-admin-layout>