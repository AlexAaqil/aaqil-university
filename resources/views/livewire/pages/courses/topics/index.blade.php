<div class="Courses">
    <div class="container">
        <div class="breadcrumbs">
            <a href="{{ Route::has('admin.courses.index') ? route('admin.courses.index') : '#' }}">Courses</a>
            <a href="{{ Route::has('admin.course.specializations.index') ? route('admin.course.specializations.index', $specialization->course->slug) : '#' }}">{{ $specialization->course->title }}</a>
            <span>{{ $specialization->title }}</span>
            <span>Topics</span>
        </div>

        <div class="header">
            <div class="info">
                <h2>Topics for {{ $specialization->title }}</h2>
                <div class="stats">
                    <span>{{ $specialization->topics_count }} {{ Str::plural('topic', $specialization->topics_count) }}</span>
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
                <a href="{{ Route::has('admin.specialization.topics.create') ? route('admin.specialization.topics.create', [$specialization->course->slug, $specialization->slug]) : '#' }}" class="btn">New Topic</a>
            </div>
        </div>

        <div class="courses_list small_cards">
            @forelse ($topics as $topic)
                <div class="course card" wire:key="user-{{ $topic->id }}">
                    <div class="details">
                        <div class="image">
                            @if ($topic->image_url)
                                <img src="{{ $topic->image_url }}" alt="{{ $topic->slug }}" class="rounded-lg w-20 h-20 object-cover">
                            @else
                                <span class="bg-red-200 text-xl text-gray-700 rounded-lg w-20 h-20 flex items-center justify-center font-semibold uppercase">{{ substr($topic->title, 0, 1) }}</span>
                            @endif
                        </div>

                        <div class="info">
                            <h3>{{ $topic->title }}</h3>
                            <a href="{{ Route::has('admin.topic.lessons.index') ? route('admin.topic.lessons.index', [$topic->specialization->course->slug, $topic->specialization->slug, $topic->slug]) : '#' }}" wire:navigate>
                                <p>{{ $topic->lessons_count }} {{ Str::plural('lesson', $topic->lessons_count) }}</p>
                            </a>
                        </div>
                    </div>

                    <div class="actions">
                        <div class="crud">
                            <a href="{{ Route::has('specialization-topics.edit') ? route('specialization-topics.edit', [$topic->uuid, $specialization->slug]) : '#' }}" class="edit">
                                <x-svgs.edit />
                            </a>

                            <button x-data x-on:click.prevent="$wire.set('delete_topic_id', {{ $topic->id }}); $dispatch('open-modal', 'confirm-topic-deletion')" class="delete">
                                <x-svgs.trash />
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <p>No topics found for this specialization.</p>
            @endforelse
        </div>

        {{-- ✅ Pagination --}}
        <div class="mt-6">
            {{ $topics->links() }}
        </div>
    </div>

    <x-modal name="confirm-topic-deletion" :show="$delete_topic_id !== null" focusable>
        <div class="custom_form">
            <form wire:submit="deleteTopic" @submit="$dispatch('close-modal', 'confirm-topic-deletion')" class="p-6">
                <h2 class="text-lg font-semibold text-gray-900">Confirm Deletion</h2>

                <p class="mt-2 mb-4 text-sm text-gray-600">Are you sure you want to permanently delete this topic?</p>

                <div class="mt-6 flex justify-start">
                    <button type="button" class="mr-2" x-on:click="$dispatch('close-modal', 'confirm-topic-deletion')">
                        Cancel
                    </button>
                    <button type="submit" class="btn_danger">
                        Delete Topic
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</div>
