<div class="CoursesPage">
    <section class="Lessons">
        <div class="lessons_container">
            <aside class="lessons_aside">
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
                                {{ $lesson->title }} (empty)
                            </a>
                        @endif
                    @endforeach
                </div>
            </aside>

            <div class="lessons_contents">
                @foreach($topic->lessons as $lesson)
                    @foreach($lesson->sections as $section)
                        <div id="section-{{ $section->id }}" class="section_content">
                            <h1>{{ $section->title }}</h1>
                            {!! $section->content !!}
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
</div>
