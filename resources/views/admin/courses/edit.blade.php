<x-admin-layout class="Courses">
    <div class="custom_form">
        <div class="header">
            <h1>Update Course</h1>
        </div>

        <form action="{{ route('courses.update', ['course' => $course->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="row_input_group">
                <div class="input_group">
                    <label for="title">Course Title</label>
                    <input type="text" name="title" id="title" placeholder="Course Title" value="{{ old('title', $course->title) }}">
                    <span class="inline_alert">{{ $errors->first('title') }}</span>
                </div>
    
                <div class="input_group">
                    <label for="visibility">Visible</label>
                    <div class="custom_radio_buttons">
                        <label>
                            <input class="option_radio" type="radio" name="visibility" id="visible" value="1" {{ $course->visibility == 1 ? 'checked' : '' }}>
                            <span>Yes</span>
                        </label>

                        <label>
                            <input class="option_radio" type="radio" name="visibility" id="not_visible" value="0" {{ $course->visibility == 0 ? 'checked' : '' }}>
                            <span>No</span>
                        </label>
                    </div>
                    <span class="inline_alert">{{ $errors->first('visibility') }}</span>
                </div>
            </div>

            <div class="input_group">
                <div class="input_group">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" placeholder="Short description of the course" value="{{ old('description', $course->description) }}">
                    <span class="inline_alert">{{ $errors->first('description') }}</span>
                </div>
            </div>

            <div class="input_group">
                <label for="thumbnail">Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" accept=".png, .jpg, .jpeg, .webp" />
                <span class="inline_alert">{{ $errors->first('thumbnail') }}</span>
            </div>

            @if(!empty(session('success')))
                <span class="inline_alert_success">{{ session('success')['message'] }}</span>
            @endif

            <div class="form_image course_thumbnail">
                @if(!empty($course->thumbnail))
                    <div class="image course_image">
                        <img src="{{ asset('storage/course_thumbnails/' . $course->thumbnail) }}" alt="{{ $course->title }}" />
                        <a href="#" >
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </div>
                @endif
            </div>

            <button type="submit">Update</button>
        </form>
    </div>
</x-admin-layout>