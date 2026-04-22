<div class="CoursesPage">
    <section class="Courses">
        <div class="container">
            <div class="breadcrumbs">
                <a href="{{ Route::has('courses') ? route('courses') : '#' }}" wire:navigate>Courses</a>
                <span>{{ $course->title }}</span>
                <span>Specializations</span>
            </div>

            <div class="section_header">
                <h2>Specializations for {{ $course->title }}</h2>
            </div>

            <ol class="specializations_list small_cards">
                @forelse($specializations as $specialization)
                    <div class="specialization card">
                        <div class="details">
                            <div class="image">
                                @if ($specialization->image_url)
                                    <img src="{{ $specialization->image_url }}" alt="{{ $specialization->slug }}" class="rounded-lg w-20 h-20 object-cover">
                                @else
                                    <span class="bg-red-200 text-xl text-gray-700 rounded-lg w-20 h-20 flex items-center justify-center font-semibold uppercase">{{ substr($specialization->title, 0, 1) }}</span>
                                @endif
                            </div>

                            <div class="info">
                                <h3>{{ $specialization->title }}</h3>
                                <a href="{{ Route::has('course.topics') ? route('course.topics', [$specialization->course->slug, $specialization->slug]) : '#' }}" class="title" wire:navigate>
                                    <p>{{ $specialization->topics_count }} {{ Str::plural('topic', $specialization->topics_count) }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No specializations have been added.</p>
                @endforelse
            </ol>
        </div>
    </section>
</div>
