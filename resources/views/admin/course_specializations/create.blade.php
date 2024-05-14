<x-admin-layout class="Course">
    <div class="custom_form">
        <div class="header">
            <h1>New Course Specialization</h1>
        </div>

        <form action="{{ route('course-specializations.store') }}" method="post">
            @csrf

            <div class="input_group">
                <label for="title">Specialization Title</label>
                <input type="text" name="title" id="title" placeholder="Course Title" value="{{ old('title') }}">
                <span class="inline_alert">{{ $errors->first('title') }}</span>
            </div>

            <div class="input_group courses_inputs">
                <label>Select Courses:</label>
                @foreach($courses as $course)
                    <div class="row_input_group">
                        <div class="custom_checkbox">
                            <label for="course_{{ $course->id }}">
                                <input type="checkbox" class="course-checkbox" id="course_{{ $course->id }}" name="courses[]" value="{{ $course->id }}" {{ (is_array(old('courses')) && in_array($course->id, old('courses'))) ? 'checked' : '' }}>
                                {{ $course->title }}
                            </label>
                        </div>
                        <div class="ordering-input" style="display: none;">
                            <label for="ordering_{{ $course->id }}">Ordering for {{ $course->title }}:</label>
                            <input type="number" id="ordering_{{ $course->id }}" name="orderings[{{ $course->id }}]" min="1" value="{{ old('orderings.' . $course->id, 500) }}">
                        </div>
                    </div>
                @endforeach
                <span class="inline_alert">{{ $errors->first('courses') }}</span>
            </div>

            <button type="submit">Save</button>
        </form>
    </div>

    <x-slot name="javascript">
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const courseCheckboxes = document.querySelectorAll('.course-checkbox');
        
                courseCheckboxes.forEach(function(checkbox) {
                    checkbox.addEventListener('change', function() {
                        const courseId = this.value;
                        const orderingInput = document.querySelector(`#ordering_${courseId}`);
        
                        if (this.checked) {
                            orderingInput.closest('.ordering-input').style.display = 'block';
                        } else {
                            orderingInput.closest('.ordering-input').style.display = 'none';
                        }
                    });
                });
            });
        </script>
    </x-slot>
</x-admin-layout>
