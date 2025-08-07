<x-app-layout>
    <div class="Courses SpecializationTopics">
        <div class="custom_form">
            <div class="header">
                <h1>Update {{ $specialization->title }} Topic</h1>
            </div>

            <form action="{{ route('specialization-topics.update', [$topic->uuid, $specialization->slug]) }}" method="post">
                @csrf
                @method('PATCH')

                <input type="hidden" name="specialization_id" id="specialization_id" value="{{ $specialization->id }}" />
                <input type="hidden" name="sort_order" id="sort_order" placeholder="Sort Order" value="{{ $topic->sort_order }}">

                <div class="inputs">
                    <label for="title">Topic Title</label>
                    <input type="text" name="title" id="title" placeholder="Topic Title" value="{{ old('title', $topic->title) }}">
                    <x-form-input-error field="title" />
                </div>

                <button type="submit">Update</button>
            </form>
        </div>
    </div>
</x-app-layout>
