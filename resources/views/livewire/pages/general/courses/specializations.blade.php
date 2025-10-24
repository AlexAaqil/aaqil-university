<div class="CoursesPage">
    <section class="Courses">
        <div class="container">
            <div class="breadcrumbs">
                <a href="{{ Route::has('courses') ? route('courses') : '#' }}" wire:navigate>Courses</a>
                <span>Web Development</span>
                <span>Specializations</span>
            </div>

            <div class="section_header">
                <h2>Specializations for {{ $course->title }}</h2>
            </div>

            <ol class="specializations_list">
                @forelse($specializations as $specialization)
                    <li class="specialization">
                        <a href="{{ Route::has('course.topics') ? route('course.topics', [$specialization->course->slug, $specialization->slug]) : '#' }}" class="title" wire:navigate>{{ $specialization->title }}</a>
                    </li>
                @empty
                    <p>No specializations have been added.</p>
                @endforelse
            </ol>
        </div>
    </section>
</div>
