<x-app-layout>
    <div class="Course CourseSpecialization">
        <div class="custom_form">
            <div class="header">
                <a href="{{ route('admin.course.specializations.index', $course->slug) }}">
                    <x-svgs.arrow-left class="w-5 h-5" />
                </a>
                <h1>New {{ $course->title }} Specialization</h1>
            </div>

            <form action="{{ route('admin.course.specializations.store', $course) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="course_id" value="{{ $course->id }}">

                <div class="inputs">
                    <label for="title">Specialization Title</label>
                    <input type="text" name="title" id="title" placeholder="e.g. Advanced Web Development"
                           value="{{ old('title') }}" required>
                    <x-form-input-error field="title" />
                </div>

                <div class="inputs">
                    <label for="description">Description (optional)</label>
                    <textarea name="description" id="description" rows="4" placeholder="Briefly describe this specialization...">{{ old('description') }}</textarea>
                    <x-form-input-error field="description" />
                </div>

                <div class="inputs">
                    <label for="image">Image (optional)</label>
                    <input type="file" name="image" id="image" accept="image/*">
                    <x-form-input-error field="image" />
                </div>

                <div class="inputs">
                    <label for="sort_order">Sort Order (optional)</label>
                    <input type="number" name="sort_order" id="sort_order" min="1" value="{{ old('sort_order') }}">
                    <x-form-input-error field="sort_order" />
                </div>

                <div class="inputs flex items-center space-x-2">
                    <input type="checkbox" name="is_published" id="is_published" value="1"
                           {{ old('is_published', true) ? 'checked' : '' }}>
                    <label for="is_published">Published</label>
                    <x-form-input-error field="is_published" />
                </div>

                <div class="mt-6">
                    <button type="submit" class="btn btn-primary">
                        Save Specialization
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
