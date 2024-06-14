<x-admin-layout class="Course">
    {{-- <x-admin-header 
        :header_title="$topic->title . ' Lessons'"
        :total_count="count($topic->lessons)"
        route="{{ route('lessons.create') }}"
    /> --}}

    <div class="body course_contents">
        <aside>
            <h1>{{ $topic->title }} <a href="{{ route('lessons.create') }}">+</a></h1>
            <div class="links">
                @foreach($topic->lessons as $lesson)
                    @if($lesson->sections->isNotEmpty())
                        <a href="#section-{{ $lesson->sections->first()->id }}">
                            {{ $lesson->title }}
                        </a>
                    @else
                        <a href="#">
                            {{ $lesson->title }} (empty)
                        </a>
                    @endif
                @endforeach
            </div>
        </aside>

        <div class="contents">
            <ul>
                @if(count($topic->lessons) != 0)
                    @foreach($topic->lessons as $lesson)
                        @foreach($lesson->sections as $section)
                            <div id="section-{{ $section->id }}" class="section_content">
                                <h1>{{ $section->title }}</h1>
                                {!! $section->content !!}
                            </div>
                        @endforeach
                    @endforeach
                @else
                    <span>No lessons yet</span>
                @endif
            </ul>
        </div>
    </div>

    <x-slot name="javascript">
        <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    </x-slot>
</x-admin-layout>