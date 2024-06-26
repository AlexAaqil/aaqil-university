<x-general-layout class="Course">
    <section class="Hero">
        <div class="container">
            <h1>Explore Our Courses</h1>
        </div>
    </div>

    <section class="Courses">
        <div class="container courses_wrapper">
            @foreach($courses as $course)
                <div class="course">
                    <a href="{{ route('course.specializations', $course->slug) }}">
                        <x-card-image 
                            :subject="$course"
                            field="thumbnail"
                            assets_folder="storage/course_thumbnails"
                        />
                    </a>

                    <div class="text">
                        <a href="{{ route('course.specializations', $course->slug) }}">
                            <h1>{{ $course->title }}</h1>
                        </a>
                        <p>{{ $course->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-general-layout>