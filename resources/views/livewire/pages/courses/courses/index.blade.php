<div class="Courses">
    <div class="container">
        <div class="header">
            <div class="info">
                <h2>Courses</h2>
                <div class="stats">
                    <span>{{ $count_courses }} {{ Str::plural('course', $count_courses) }}</span>
                    <span>{{ $count_unpublished }} unpublished</span>
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
                <a href="{{ Route::Has('courses.create') ? route('courses.create') : '#' }}" class="btn">New Course</a>
            </div>
        </div>

        <div class="courses_list small_cards">
            @forelse ($courses as $course)
                <div class="course card" wire:key="user-{{ $course->id }}">
                    <div class="details">
                        <div class="image">
                            <img src="" alt="">
                        </div>

                        <div class="info">
                            <h3>{{ $course->title }}</h3>
                            <p>{{ $course->description }}</p>
                        </div>
                    </div>

                    <div class="actions">
                        <div class="others">
                            <span wire:click="togglePublished({{ $course->id }})"
                                wire:loading.attr="disabled"
                                wire:target="togglePublished"
                                class="{{ $course->isPublished() ? 'border border-green-500 bg-green-100 text-green-900 text-xs p-1' : 'border border-red-500 bg-red-100 text-red-900 text-xs p-1' }}">
                                {{ $course->is_published_label }}
                            </span>
                        </div>

                        <div class="crud">
                            <a href="{{ Route::has('courses.edit') ? route('courses.edit', ['uuid' => $course->uuid]) : '#' }}" wire:navigate class="edit">
                                <x-svgs.edit />
                            </a>

                            <button x-data x-on:click.prevent="$wire.set('delete_course_id', {{ $course->id }}); $dispatch('open-modal', 'confirm-course-deletion')" class="delete">
                                <x-svgs.edit />
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <p>No courses found.</p>
            @endforelse
        </div>

        {{-- ✅ Pagination --}}
        <div class="mt-6">
            {{ $courses->links() }}
        </div>
    </div>

    <x-modal name="confirm-course-deletion" :show="$delete_course_id !== null" focusable>
        <div class="custom_form">
            <form wire:submit="deleteCourse" @submit="$dispatch('close-modal', 'confirm-course-deletion')" class="p-6">
                <h2 class="text-lg font-semibold text-gray-900">Confirm Deletion</h2>

                <p class="mt-2 mb-4 text-sm text-gray-600">Are you sure you want to permanently delete this course?</p>

                <div class="mt-6 flex justify-start">
                    <button type="button" class="mr-2" x-on:click="$dispatch('close-modal', 'confirm-course-deletion')">
                        Cancel
                    </button>
                    <button type="submit" class="btn_danger">
                        Delete Course
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</div>
