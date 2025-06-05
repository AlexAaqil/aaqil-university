<div class="CoursesPage">
    <section class="Courses">
        <div class="container">
            <div class="section_header">
                <h2>Specializations for {{ $course->title }}</h2>
            </div>

            <ol class="specializations_list">
                @forelse($specializations as $course)
                    <li class="specialization">
                        <a href="{{ Route::has('course.topics') ? route('course.topics', $course->slug) : '#' }}" class="title">{{ $course->title }}</a>
                    </li>
                @empty
                    <p>No specializations have been added.</p>
                @endforelse
            </ol>
        </div>
    </section>
</div>
