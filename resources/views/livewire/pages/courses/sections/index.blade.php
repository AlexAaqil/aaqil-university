<div class="Courses LessonSections">
    <div class="container">
        <div class="header">
            <div class="info">
                <h2>Sections for {{ $lesson->title }}</h2>
                <div class="stats">
                    <span>{{ $lesson->sections_count }} {{ Str::plural('section', $lesson->sections_count) }}</span>
                </div>
            </div>

            <div class="search">
                <div class="relative">
                    <input
                        type="text"
                        placeholder="Search by title..."
                        wire:model="search"
                        wire:keydown.enter="performSearch"
                        class="pr-8"
                    >
                    @if($search)
                        <button
                            wire:click="resetSearch"
                            class="absolute right-1 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                        >
                            X
                        </button>
                    @endif
                </div>
            </div>

            <div class="button">
                <a href="{{ Route::has('lesson-sections.create') ? route('lesson-sections.create', $lesson->id) : '#' }}" class="btn">New Section</a>
            </div>
        </div>

        <div class="sections">
            @forelse($sections as $section)
                <div class="section_content ckedited_content">
                    <h1>
                        <a href="{{ Route::has('lesson-sections.edit') ? route('lesson-sections.edit', ['section' => $section->uuid, 'lesson' => $lesson->slug]) : '#' }}">
                            {{ $section->title }}
                        </a>
                    </h1>
                    {!! $section->content !!}
                </div>
            @empty
                <div class="no_sections">
                    <p>No sections available for this lesson.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
