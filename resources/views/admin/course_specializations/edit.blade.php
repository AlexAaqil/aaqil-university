<x-admin-layout class="Course_specializations">
    <div class="custom_form">
        <div class="header">
            <h1>Update Course Specialization</h1>
        </div>

        <form action="{{ route('course-specializations.update', $course_specialization->id) }}" method="post">
            @csrf
            @method('PATCH')

            <div class="input_group">
                <label for="title">Specialization Title</label>
                <input type="text" name="title" id="title" placeholder="Course Title" value="{{ old('title', $course_specialization->title) }}">
                <span class="inline_alert">{{ $errors->first('title') }}</span>
            </div>

            <div class="input_group courses_inputs">
                <label>Select Courses:</label>
                @foreach($courses as $course)
                    <div class="row_input_group">
                        <div class="custom_checkbox">
                            <label for="course_{{ $course->id }}">
                                <input type="checkbox" class="course-checkbox" id="course_{{ $course->id }}" name="courses[]" value="{{ $course->id }}" {{ $course_specialization->courses->contains($course->id) ? 'checked' : '' }}>
                                {{ $course->title }}
                            </label>
                        </div>
                        <div class="ordering-input">
                            <label for="ordering_{{ $course->id }}">Ordering for {{ $course->title }}:</label>
                            <input type="number" id="ordering_{{ $course->id }}" name="orderings[{{ $course->id }}]" min="1" value="{{ $course_specialization->courses->contains($course->id) ? $course_specialization->courses->find($course->id)->pivot->ordering : 500 }}">
                        </div>
                    </div>
                @endforeach
                <span class="inline_alert">{{ $errors->first('courses') }}</span>
            </div>

            <button type="submit">Update</button>
        </form>
    </div>
</x-admin-layout>