<x-general-layout class="CoursesPage">
    <section class="Hero">
        <div class="container">
            <h1>Explore Our Courses</h1>
        </div>
    </div>

    <section class="Courses">
        <div class="container">
            @foreach($courses as $course)
                <div class="course">
                    <x-card-image 
                        :subject="$course"
                        field="thumbnail"
                        assets_folder="storage/course_thumbnails"
                    />

                    <div class="text">
                        <h1>{{ $course->title }}</h1>
                        <p>{{ $course->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-general-layout>