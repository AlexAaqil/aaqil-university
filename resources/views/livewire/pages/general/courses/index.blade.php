<div class="CoursesPage">
    <section class="Courses">
        <div class="container">
            <div class="section_header">
                <h2>Select a course</h2>
            </div>

            <div class="courses_list">
                @foreach($courses as $course)
                <div class="course">
                    <div class="image">
                        <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}">
                    </div>

                    <div class="text">
                        <a href="{{ Route::has('course.specializations') ? route('course.specializations', $course->slug) : '#' }}" class="title">{{ $course->title }}</a>
                        <p class="description">{{ $course->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
