<x-app-layout>
    <div class="Courses">
        <div class="custom_form max-w-2xl mx-auto py-4">
            <div class="header">
                <h1>Update Course</h1>
            </div>

            <form action="{{ route('courses.update', $course->uuid) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="inputs">
                    <label for="title">Course Title</label>
                    <input type="text" name="title" id="title" placeholder="Course Title" value="{{ old('title', $course->title) }}">
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

                @if(!empty(session('success')))
                    <span class="inline_alert_success">{{ session('success')['message'] }}</span>
                @endif

                <div class="form_image course_thumbnail">
                    @if(!empty($course->image))
                        <div class="image course_image">
                            <img src="{{ asset('storage/course_thumbnails/' . $course->image) }}" alt="{{ $course->title }}" />
                            <a href="#" >
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    @endif
                </div>

                <div class="inputs">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" placeholder="Short description of the course" value="{{ old('description', $course->description) }}">
                    <x-form-input-error field="description" />
                </div>

                <button type="submit">Update</button>
            </form>
        </div>
    </div>
</x-app-layout>
