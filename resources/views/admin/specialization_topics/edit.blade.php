<x-admin-layout class="Course">
    <div class="custom_form">
        <div class="header">
            <h1>Update {{ $specialization->title }} Topic</h1>
        </div>

        <form action="{{ route('topics.update', $topic->id) }}" method="post">
            @csrf
            @method('PATCH')

            <div class="row_input_group">
                <input type="hidden" name="specialization_id" id="specialization_id" value="{{ $specialization->id }}" />

                <div class="input_group">
                    <label for="title">Topic Title</label>
                    <input type="text" name="title" id="title" placeholder="Topic Title" value="{{ old('title', $topic->title) }}">
                    <span class="inline_alert">{{ $errors->first('title') }}</span>
                </div>
    
                <div class="input_group">
                    <label for="ordering">Ordering</label>
                    <input type="number" name="ordering" id="ordering" placeholder="Ordering" value="{{ old('ordering', $topic->ordering) }}">
                    <span class="inline_alert">{{ $errors->first('ordering') }}</span>
                </div>
            </div>           

            <button type="submit">Update</button>
        </form>
    </div>
</x-admin-layout>