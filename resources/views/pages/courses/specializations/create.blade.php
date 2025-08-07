<x-app-layout>
    <div class="Course CourseSpecialization">
        <div class="custom_form">
            <div class="header">
                <a href="{{ Route::has('course-specializations.index') ? route('course-specializations.index', $course->slug) : '#' }}">
                    <x-svgs.arrow-left class="w-5 h-5" />
                </a>
                <h1>New {{ $course->title }} Specialization</h1>
            </div>

            <form action="{{ route('course-specializations.store') }}" method="post">
                @csrf

                <div class="inputs">
                    <label for="title">Course Specialization Title</label>
                    <input type="text" name="title" id="title" placeholder="Course Specialization Title" value="{{ old('title') }}">
                    <x-form-input-error field="title" />
                </div>

                <div class="input_group courses_inputs">
                    <label>Select Courses:</label>
                    @foreach($courses as $course)
                        @php
                            $isCurrent = $course->id === $course->id;
                        @endphp

                        <div class="inputs_group">
                            <div class="inputs custom_checkbox">
                                <label for="course_{{ $course->id }}">
                                    <input
                                        type="checkbox"
                                        class="course-checkbox"
                                        id="course_{{ $course->id }}"
                                        name="courses[]"
                                        value="{{ $course->id }}"
                                        {{ $isCurrent || (is_array(old('courses')) && in_array($course->id, old('courses'))) ? 'checked' : '' }}
                                        {{ $isCurrent ? 'readonly onclick="return false;"' : '' }}
                                    >
                                    {{ $course->title }}
                                    @if($isCurrent)
                                        <span class="badge">[Current]</span>
                                    @endif
                                </label>
                            </div>

                            <div class="inputs ordering-input" style="{{ $isCurrent || (is_array(old('courses')) && in_array($course->id, old('courses'))) ? '' : 'display: none;' }}">
                                <label for="ordering_{{ $course->id }}">Sort Order {{ $course->title }}:</label>
                                <input
                                    type="number"
                                    id="ordering_{{ $course->id }}"
                                    name="sort_order[{{ $course->id }}]"
                                    min="1"
                                    value="{{ old('sort_order.' . $course->id, $isCurrent ? 1 : 100) }}"
                                    {{ $isCurrent ? 'readonly' : '' }}
                                >
                            </div>
                        </div>
                    @endforeach
                    <x-form-input-error field="courses" />
                </div>

                <button type="submit">Save</button>
            </form>
        </div>
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
</x-app-layout>
