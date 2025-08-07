<x-app-layout>
    <div class="Courses">
        <div class="custom_form max-w-2xl mx-auto py-4">
            <div class="header">
                <h2>New Course</h2>
            </div>

            <form action="{{ route('courses.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="inputs">
                    <label for="title">Course Title</label>
                    <input type="text" name="title" id="title" placeholder="Course Title" value="{{ old('title') }}">
                    <x-form-input-error field="title" />
                </div>

                <div class="inputs">
                    <label for="is_published">
                        <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }}>
                        Publish
                    </label>
                    <x-form-input-error field="is_published" />
                </div>

                <div class="inputs">
                    <label for="image">Course Image</label>
                    <input type="file" name="image" id="image" accept=".png, .jpg, .jpeg, .webp" />
                    <x-form-input-error field="image" />
                </div>

                <div class="inputs">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" placeholder="Short description of the course" value="{{ old('description') }}">
                    <x-form-input-error field="description" />
                </div>

                <button type="submit">Save</button>
            </form>
        </div>
    </div>
</x-app-layout>
