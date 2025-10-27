<div class="Courses">
    <div class="container">
        <div class="breadcrumbs">
            <a href="{{ Route::has('admin.courses.index') ? route('admin.courses.index') : '#' }}">Courses</a>
            <span>{{ $course->title }}</span>
            <span>Specializations</span>
        </div>

        <div class="header">
            <div class="info">
                <h2>Specializations for {{ $course->title }}</h2>
                <div class="stats">
                    <span>{{ $course->specializations_count }} {{ Str::plural('specialization', $course->specializations_count) }}</span>
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
                <a href="{{ Route::has('admin.course.specializations.create') ? route('admin.course.specializations.create', $course->id) : '#' }}" class="btn">New Specialization</a>
            </div>
        </div>

        <div class="courses_list small_cards">
            @forelse ($specializations as $specialization)
                <div class="course card" wire:key="user-{{ $specialization->id }}">
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
                            <a href="{{ Route::has('admin.specialization.topics.index') ? route('admin.specialization.topics.index', [$specialization->course->slug, $specialization->slug]) : '#' }}">
                                <p>{{ $specialization->topics_count }} {{ Str::plural('topic', $specialization->topics_count) }}</p>
                            </a>
                        </div>
                    </div>

                    <div class="actions">
                        <div class="crud">
                            <a href="{{ Route::has('admin.course.specializations.edit') ? route('admin.course.specializations.edit', [$specialization->course, $specialization]) : '#' }}" class="edit">
                                <x-svgs.edit />
                            </a>

                            <button x-data x-on:click.prevent="$wire.set('delete_course_id', {{ $specialization->id }}); $dispatch('open-modal', 'confirm-specialization-deletion')" class="delete">
                                <x-svgs.trash />
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <p>No specializations found for this course.</p>
            @endforelse
        </div>

        {{-- ✅ Pagination --}}
        <div class="mt-6">
            {{ $specializations->links() }}
        </div>
    </div>

    <x-modal name="confirm-specialization-deletion" :show="$delete_specialization_id !== null" focusable>
        <div class="custom_form">
            <form wire:submit="deleteSpecialization" @submit="$dispatch('close-modal', 'confirm-specialization-deletion')" class="p-6">
                <h2 class="text-lg font-semibold text-gray-900">Confirm Deletion</h2>

                <p class="mt-2 mb-4 text-sm text-gray-600">Are you sure you want to permanently delete this specialization and it's topics?</p>

                <div class="mt-6 flex justify-start">
                    <button type="button" class="mr-2" x-on:click="$dispatch('close-modal', 'confirm-specialization-deletion')">
                        Cancel
                    </button>
                    <button type="submit" class="btn_danger">
                        Delete Specialization
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</div>
