<x-admin-layout class="Courses">
    <div class="custom_form">
        <div class="header">
            <h1>New Course</h1>
        </div>

        <form action="{{ route('courses.store') }}" method="post">
            @csrf

            <div class="input_group">
                <label for="title">Course</label>
                <input type="text" name="title" id="title" placeholder="Course Title" value="{{ old('title') }}">
                <span class="inline_alert">{{ $errors->first('title') }}</span>
            </div>

            <div class="row_input_group">
                <div class="input_group">
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" placeholder="Price" value="{{ old('price') }}">
                    <span class="inline_alert">{{ $errors->first('price') }}</span>
                </div>

                <div class="input_group">
                    <label for="duration_in_months">Duration in Months</label>
                    <input type="number" name="duration_in_months" id="duration_in_months" placeholder="Duration in Months" value="{{ old('duration_in_months') }}">
                    <span class="inline_alert">{{ $errors->first('duration_in_months') }}</span>
                </div>
            </div>

            <div class="input_group">
                <div class="input_group">
                    <label for="short_description">Short Description</label>
                    <input type="text" name="short_description" id="short_description" placeholder="Short Description" value="{{ old('short_description') }}">
                    <span class="inline_alert">{{ $errors->first('short_description') }}</span>
                </div>
            </div>

            <div class="input_group">
                <div class="input_group">
                    <label for="long_description">Short Description</label>
                    <textarea name="long_description" id="long_description" cols="30" rows="10" placeholder="Long Description">{{ old('long_description') }}</textarea>
                    <span class="inline_alert">{{ $errors->first('long_description') }}</span>
                </div>
            </div>

            <button type="submit">Save</button>
        </form>
    </div>
</x-admin-layout>