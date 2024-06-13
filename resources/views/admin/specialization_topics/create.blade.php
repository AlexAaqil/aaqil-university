<x-admin-layout class="Course">
    <div class="custom_form">
        <div class="header">
            <h1>New {{ $specialization->title }} Topic</h1>
        </div>

        <form action="{{ route('topics.store') }}" method="post">
            @csrf

            <input type="hidden" name="specialization_id" id="specialization_id" value="{{ $specialization->id }}" />
            <input type="hidden" name="ordering" id="ordering" placeholder="Ordering" value="500">
            <div class="input_group">
                <label for="title">Topic Title</label>
                <input type="text" name="title" id="title" placeholder="Topic Title" value="{{ old('title') }}">
                <span class="inline_alert">{{ $errors->first('title') }}</span>
            </div>

            <button type="submit">Save</button>
        </form>
    </div>
</x-admin-layout>