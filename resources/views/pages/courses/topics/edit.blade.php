<x-app-layout>
    <div class="Courses SpecializationTopics">
        <div class="custom_form">
            <div class="header">
                <h1>Update {{ $specialization->title }} Topic</h1>
            </div>

            <form action="{{ route('admin.specialization.topics.update', [$specialization->course->slug, $specialization->slug, $topic->slug]) }}" method="post">
                @csrf
                @method('PATCH')

                <input type="hidden" name="specialization_id" id="specialization_id" value="{{ $specialization->id }}" />

                <div class="inputs">
                    <label for="title">Topic Title</label>
                    <input type="text" name="title" id="title" placeholder="Topic Title" value="{{ old('title', $topic->title) }}">
                    <x-form-input-error field="title" />
                </div>

                <div class="inputs">
                    <label for="sort_order">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" placeholder="Ordering" value="{{ $topic->sort_order }}">
                    <x-form-input-error field="sort_order" />
                </div>

                <button type="submit">Update</button>
            </form>
        </div>
    </div>
</x-app-layout>
