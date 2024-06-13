<x-admin-layout class="Course">
    <div class="custom_form">
        <div class="header">
            <h1>Update {{ $specialization->title }} Topic</h1>
        </div>

        <form action="{{ route('topics.update', $topic->id) }}" method="post">
            @csrf
            @method('PATCH')

            <input type="hidden" name="specialization_id" id="specialization_id" value="{{ $specialization->id }}" />
            <input type="hidden" name="ordering" id="ordering" placeholder="Ordering" value="{{ $topic->ordering }}">

            <div class="input_group">
                <label for="title">Topic Title</label>
                <input type="text" name="title" id="title" placeholder="Topic Title" value="{{ old('title', $topic->title) }}">
                <span class="inline_alert">{{ $errors->first('title') }}</span>
            </div>

            <button type="submit">Update</button>
        </form>
    </div>
</x-admin-layout>