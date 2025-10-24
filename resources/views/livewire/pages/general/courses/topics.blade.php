<div class="CoursesPage">
    <section class="Courses">
        <div class="container">
            <div class="breadcrumbs">
                <a href="{{ Route::has('courses') ? route('courses') : '#' }}" wire:navigate>Courses</a>
                <a href="{{ Route::has('course.specializations') ? route('course.specializations', $specialization->course->slug) : '#' }}" wire:navigate>{{ $specialization->course->title }}</a>
                <span>{{ $specialization->title }}</span>
                <span>Topics</span>
            </div>

            <div class="section_header">
                <h2>Topics for {{ $specialization->title }}</h2>
            </div>

            <ol class="topics_list">
                @forelse($topics as $topic)
                    <li>
                        <a href="{{ Route::has('course.lessons') ? route('course.lessons', [$topic->specialization->course->slug, $topic->specialization->slug, $topic->slug]) : '#' }}" class="title" wire:navigate>{{ $topic->title }}</a>
                    </li>
                @empty
                    <p>No topics have been added.</p>
                @endforelse
            </ol>
        </div>
    </section>
</div>
