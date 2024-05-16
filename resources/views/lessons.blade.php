<x-app-layout>
    <main class="Course">
        <section class="course_contents">
            <aside>
                <div class="header">
                    <span>
                        <a href="{{ route('courses') }}">
                            <i class="fas fa-home"></i>
                        </a>
                    </span>
                    <h1>{{ $topic->title }}</h1>
                </div>
    
                <div class="links">
                    @foreach($topic->lessons as $lesson)
                        @if($lesson->sections->isNotEmpty())
                            <a href="#section-{{ $lesson->sections->first()->id }}">
                                {{ $lesson->title }}
                            </a>
                        @else
                            <a href="#">
                                {{ $lesson->title }} (No Sections)
                            </a>
                        @endif
                    @endforeach
                </div>
            </aside>
    
            <div class="contents">
                @foreach($topic->lessons as $lesson)
                    @foreach($lesson->sections as $section)
                        <div id="section-{{ $section->id }}" class="section_content">
                            {!! $section->content !!}
                        </div>
                    @endforeach
                @endforeach
            </div>
        </section>
    </main>
</x-app-layout>