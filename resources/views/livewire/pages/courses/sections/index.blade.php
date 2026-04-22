<div class="Courses LessonSections">
    <div class="container">
        <div class="breadcrumbs">
            <a href="{{ Route::has('admin.courses.index') ? route('admin.courses.index') : '#' }}" wire:navigate>Courses</a>
            <a href="{{ Route::has('admin.course.specializations.index') ? route('admin.course.specializations.index', $lesson->topic->specialization->course->slug) : '#' }}" wire:navigate>{{ $lesson->topic->specialization->course->title }}</a>
            <a href="{{ Route::has('admin.specialization.topics.index') ? route('admin.specialization.topics.index', [$lesson->topic->specialization->course->slug, $lesson->topic->specialization->slug]) : '#' }}" wire:navigate>{{ $lesson->topic->specialization->title }}</a>
            <a href="{{ Route::has('admin.topic.lessons.index') ? route('admin.topic.lessons.index', [$lesson->topic->specialization->course->slug, $lesson->topic->specialization->slug, $lesson->topic->slug]) : '#' }}" wire:navigate>{{ $lesson->topic->title }}</a>
            <a href="{{ Route::has('admin.topic.lessons.index') ? route('admin.topic.lessons.index', [$lesson->topic->specialization->course->slug, $lesson->topic->specialization->slug, $lesson->topic->slug]) : '#' }}" wire:navigate>Lessons</a>
            <span>{{ $lesson->title }}</span>
        </div>

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
                <a href="{{ Route::has('admin.lesson.sections.create') ? route('admin.lesson.sections.create', [$lesson->topic->specialization->course->slug, $lesson->topic->specialization->slug, $lesson->topic->slug, $lesson->slug]) : '#' }}" class="btn">New Section</a>
            </div>
        </div>

        <div class="sections">
            @forelse($sections as $section)
                <div class="section_content ckedited_content">
                    <h1 class="flex justify-between items-center">
                        <a href="{{ Route::has('admin.lesson.sections.edit') ? route('admin.lesson.sections.edit', [$lesson->topic->specialization->course->slug, $lesson->topic->specialization->slug, $lesson->topic->slug, $lesson->slug, $section->slug]) : '#' }}">
                            {{ $section->title }}
                        </a>

                        <button x-data x-on:click.prevent="$wire.set('delete_section_id', {{ $section->id }}); $dispatch('open-modal', 'confirm-section-deletion')" class="delete text-red-600">
                                <x-svgs.trash />
                        </button>
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

    <x-modal name="confirm-section-deletion" :show="$delete_section_id !== null" focusable>
        <div class="custom_form">
            <form wire:submit="deleteSection" @submit="$dispatch('close-modal', 'confirm-section-deletion')" class="p-6">
                <h2 class="text-lg font-semibold text-gray-900">Confirm Deletion</h2>

                <p class="mt-2 mb-4 text-sm text-gray-600">Are you sure you want to permanently delete this section?</p>

                <div class="mt-6 flex justify-start">
                    <button type="button" class="mr-2" x-on:click="$dispatch('close-modal', 'confirm-section-deletion')">
                        Cancel
                    </button>
                    <button type="submit" class="btn_danger">
                        Delete Section
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</div>
