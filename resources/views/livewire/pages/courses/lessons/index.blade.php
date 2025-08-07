<div class="Courses">
    <div class="container">
        <div class="header">
            <div class="info">
                <h2>Lessons for {{ $topic->title }}</h2>
                <div class="stats">
                    <span>{{ $topic->lessons_count }} {{ Str::plural('lesson', $topic->lessons_count) }}</span>
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
                <a href="{{ Route::has('topic-lessons.create') ? route('topic-lessons.create', $topic->slug) : '#' }}" class="btn">New Lesson</a>
            </div>
        </div>

        <div class="courses_list small_cards">
            @forelse ($lessons as $lesson)
                <div class="course card" wire:key="user-{{ $lesson->id }}">
                    <div class="details">
                        <div class="image">
                            @if ($lesson->image_url)
                                <img src="{{ $lesson->image_url }}" alt="{{ $lesson->slug }}" class="rounded-lg w-20 h-20 object-cover">
                            @else
                                <span class="bg-red-200 text-xl text-gray-700 rounded-lg w-20 h-20 flex items-center justify-center font-semibold uppercase">{{ substr($lesson->title, 0, 1) }}</span>
                            @endif
                        </div>

                        <div class="info">
                            <h3>{{ $lesson->title }}</h3>
                            <a href="{{ Route::has('lesson-sections.index') ? route('lesson-sections.index', $lesson->slug) : '#' }}">
                                <p>{{ $lesson->sections_count }} {{ Str::plural('section', $lesson->sections_count) }}</p>
                            </a>
                        </div>
                    </div>

                    <div class="actions">
                        <div class="crud">
                            <a href="{{ Route::has('topic-lessons.edit') ? route('topic-lessons.edit', [$lesson->uuid, $topic->slug]) : '#' }}" class="edit">
                                <x-svgs.edit />
                            </a>

                            <button x-data x-on:click.prevent="$wire.set('delete_lesson_id', {{ $lesson->id }}); $dispatch('open-modal', 'confirm-lesson-deletion')" class="delete">
                                <x-svgs.trash />
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <p>No lessons found for this topic.</p>
            @endforelse
        </div>

        {{-- ✅ Pagination --}}
        <div class="mt-6">
            {{ $lessons->links() }}
        </div>
    </div>

    <x-modal name="confirm-lesson-deletion" :show="$delete_lesson_id !== null" focusable>
        <div class="custom_form">
            <form wire:submit="$deleteLesson" @submit="$dispatch('close-modal', 'confirm-lesson-deletion')" class="p-6">
                <h2 class="text-lg font-semibold text-gray-900">Confirm Deletion</h2>

                <p class="mt-2 mb-4 text-sm text-gray-600">Are you sure you want to permanently delete this lesson?</p>

                <div class="mt-6 flex justify-start">
                    <button type="button" class="mr-2" x-on:click="$dispatch('close-modal', 'confirm-lesson-deletion')">
                        Cancel
                    </button>
                    <button type="submit" class="btn_danger">
                        Delete Lesson
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</div>
