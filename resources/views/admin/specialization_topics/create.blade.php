<x-admin-layout class="Course">
    <div class="custom_form">
        <div class="header">
            <h1>New Specialization Topic</h1>
        </div>

        <form action="{{ route('topics.store') }}" method="post">
            @csrf

            <div class="row_input_group">
                <div class="input_group">
                    <label for="title">Topic Title</label>
                    <input type="text" name="title" id="title" placeholder="Topic Title" value="{{ old('title') }}">
                    <span class="inline_alert">{{ $errors->first('title') }}</span>
                </div>
    
                <div class="input_group">
                    <label for="ordering">Ordering</label>
                    <input type="number" name="ordering" id="ordering" placeholder="Ordering" value="{{ old('ordering', 500) }}">
                    <span class="inline_alert">{{ $errors->first('ordering') }}</span>
                </div>
            </div>

            <div class="input_group">
                <label for="specialization_id">Specialization</label>
                <select name="specialization_id" id="specialization_id">
                    <option value="">Select Specialization</option>
                    @foreach($specializations as $specialization)
                        <option value="{{ $specialization->id }}" {{ old('specialization_id') == $specialization->id ? 'selected' : '' }}>{{ $specialization->title }}</option>
                    @endforeach
                </select>
                <span class="inline_alert">{{ $errors->first('specialization_id') }}</span>
            </div>            

            <button type="submit">Save</button>
        </form>
    </div>
</x-admin-layout>