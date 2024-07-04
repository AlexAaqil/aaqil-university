<x-admin-layout class="Course">
    <div class="related_pages">
        <a href="{{ route('lessons.index', $lesson->topic->id) }}">Lesson</a>
        <span>Sections</span>
    </div>

    <x-admin-header 
        :header_title="$lesson->title . ' Sections'"
        :total_count="count($lesson->sections)"
        route="{{ route('sections.create', $lesson->id) }}"
    />

    <section class="body">
        @if(count($lesson->sections) != 0)
            @foreach($lesson->sections as $section)
                <div class="searchable">
                    <div class="section_content">
                        <h1>
                            <a href="{{ route('sections.edit', ['section' => $section->id, 'lesson' => $lesson->id]) }}">
                                {{ $section->title }}
                            </a>
                        </h1>
                        {!! $section->content !!}
                    </div>
                </div>
                <hr>
            @endforeach
        @else
            <p>No sections yet</p>
        @endif
    </section>
</x-admin-layout>