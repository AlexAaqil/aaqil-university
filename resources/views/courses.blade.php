<x-general-layout class="Course">
    <section class="Hero">
        <div class="container">
            <h1>Explore Our Courses</h1>
        </div>
    </div>

    <section class="Courses">
        <div class="container">
            @foreach($courses as $course)
                <div class="course">
                    <a href="{{ route('course_specializations', $course->slug) }}">
                        <x-card-image 
                            :subject="$course"
                            field="thumbnail"
                            assets_folder="storage/course_thumbnails"
                        />
                    </a>

                    <div class="text">
                        <h1>
                            <a href="{{ route('course_specializations', $course->slug) }}">
                                {{ $course->title }}</h1>
                            </a>
                        <p>{{ $course->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-general-layout>