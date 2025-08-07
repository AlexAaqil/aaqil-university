<x-app-layout>
    <div class="Course SpecializationTopics">
        <div class="custom_form">
            <div class="header">
                <a href="{{ Route::has('specialization-topics.index') ? route('specialization-topics.index', $specialization->slug) : '#' }}">
                    <x-svgs.arrow-left class="w-5 h-5" />
                </a>
                <h1>New {{ $specialization->title }} Topic</h1>
            </div>

            <form action="{{ route('specialization-topics.store', $specialization) }}" method="post">
                @csrf

                <input type="hidden" name="specialization_id" id="specialization_id" value="{{ $specialization->id }}" />
                <input type="hidden" name="sort_order" id="sort_order" placeholder="Ordering" value="100">

                <div class="inputs">
                    <label for="title">Topic Title</label>
                    <input type="text" name="title" id="title" placeholder="Topic Title" value="{{ old('title') }}">
                    <x-form-input-error field="title" />
                </div>

                <button type="submit">Save</button>
            </form>
        </div>
    </div>
</x-app-layout>
