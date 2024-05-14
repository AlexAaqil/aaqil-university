<x-admin-layout class="Course">
    <div class="custom_form">
        <div class="header">
            <h1>New Course</h1>
        </div>

        <form action="{{ route('courses.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row_input_group">
                <div class="input_group">
                    <label for="title">Course Title</label>
                    <input type="text" name="title" id="title" placeholder="Course Title" value="{{ old('title') }}">
                    <span class="inline_alert">{{ $errors->first('title') }}</span>
                </div>
    
                <div class="input_group">
                    <label for="visibility">Visible</label>
                    <div class="custom_radio_buttons">
                        <label>
                            <input class="option_radio" type="radio" name="visibility" id="visible" value="1" {{ old('visibility', 1) == '1' ? 'checked' : '' }}>
                            <span>Yes</span>
                        </label>

                        <label>
                            <input class="option_radio" type="radio" name="visibility" id="not_visible" value="0" {{ old('visibility') == '0' ? 'checked' : '' }}>
                            <span>No</span>
                        </label>
                    </div>
                    <span class="inline_alert">{{ $errors->first('visibility') }}</span>
                </div>
            </div>

            <div class="input_group">
                <div class="input_group">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" placeholder="Short description of the course" value="{{ old('description') }}">
                    <span class="inline_alert">{{ $errors->first('description') }}</span>
                </div>
            </div>

            <div class="input_group">
                <label for="thumbnail">Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" accept=".png, .jpg, .jpeg, .webp" />
                <span class="inline_alert">{{ $errors->first('thumbnail') }}</span>
            </div>

            <button type="submit">Save</button>
        </form>
    </div>
</x-admin-layout>