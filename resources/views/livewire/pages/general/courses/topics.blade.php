<div class="CoursesPage">
    <section class="Courses">
        <div class="container">
            <div class="section_header">
                <h2>Topics for {{ $specialization->title }}</h2>
            </div>

            <ol class="topics_list">
                @forelse($topics as $topic)
                    <li>
                        <a href="{{ Route::has('course.lessons') ? route('course.lessons', $topic->slug) : '#' }}" class="title">{{ $topic->title }}</a>
                    </li>
                @empty
                    <p>No topics have been added.</p>
                @endforelse
            </ol>
        </div>
    </section>
</div>
