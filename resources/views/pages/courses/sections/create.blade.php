<x-app-layout>
    <div class="Courses LessonSections">
        <div class="custom_form">
            <div class="header">
                <a href="{{ Route::has('admin.lesson.sections.index') ? route('admin.lesson.sections.index', [$lesson->topic->specialization->course->slug, $lesson->topic->specialization->slug, $lesson->topic->slug, $lesson->slug]) : '#' }}">
                    <x-svgs.arrow-left class="w-5 h-5" />
                </a>
                <h1>New {{ $lesson->title }} Section</h1>
            </div>

            <form action="{{ route('admin.lesson.sections.store', [$lesson->topic->specialization->course->slug, $lesson->topic->specialization->slug, $lesson->topic->slug, $lesson->slug]) }}" method="post">
                @csrf

                <input type="hidden" name="sort_order" id="sort_order" value="500">
                <input type="hidden" name="lesson_id" id="lesson_id" value="{{ $lesson->id }}">

                <div class="inputs">
                    <label for="title">Section Title</label>
                    <input type="text" name="title" id="title" placeholder="Section Title" value="{{ old('title') }}">
                    <x-form-input-error field="title" />
                </div>

                <div class="inputs">
                    <label for="content">Section Content</label>
                    <textarea name="content" id="ckeditor" cols="30" rows="10" placehoder="Enter the section content">{{ old('content') }}</textarea>
                    <x-form-input-error field="content" />
                </div>

                <button type="submit">Save</button>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('assets/js/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/js/ckeditor-customization.js') }}"></script>
    @endpush
</x-app-layout>
