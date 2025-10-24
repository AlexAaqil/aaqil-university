<div class="CoursesPage">
    <section class="Courses">
        <div class="container">
            <div class="section_header">
                <h2>Select a course</h2>
            </div>

            <div class="courses_list">
                @forelse($courses as $course)
                <div class="course">
                    <div class="image">
                        <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}">
                    </div>

                    <div class="text">
                        <a href="{{ Route::has('course.specializations') ? route('course.specializations', [$course->slug]) : '#' }}" class="title" wire:navigate>{{ $course->title }}</a>
                        <p class="description">{{ $course->description }}</p>
                    </div>
                </div>
                @empty
                    <p>There are no available courses at the moment.</p>
                @endforelse
            </div>
        </div>
    </section>
</div>
