<div class="CoursesPage">
    <section class="Courses">
        <div class="container">
            <div class="section_header">
                <h2>Select a course</h2>
            </div>

            <div class="courses_list small_cards">
                @forelse($courses as $course)
                    <div class="course card">
                        <div class="details">
                            <div class="image">
                                @if ($course->image_url)
                                    <img src="{{ $course->image_url }}" alt="{{ $course->slug }}" class="rounded-lg w-20 h-20 object-cover">
                                @else
                                    <span class="bg-red-200 text-xl text-gray-700 rounded-lg w-20 h-20 flex items-center justify-center font-semibold uppercase">{{ substr($course->title, 0, 1) }}</span>
                                @endif
                            </div>

                            <div class="info">
                                <h3>{{ $course->title }}</h3>
                                <a href="{{ Route::has('course.specializations') ? route('course.specializations', [$course->slug]) : '#' }}" class="title" wire:navigate>
                                    <p>{{ $course->specializations_count }} {{ Str::plural('specialization', $course->specializations_count) }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>There are no available courses at the moment.</p>
                @endforelse
            </div>
        </div>
    </section>
</div>
