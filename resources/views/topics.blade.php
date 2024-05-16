<x-general-layout class="Course">
    <section class="Hero">
        <div class="container">
            <h1>{{ $specialization->title }} Topics</h1>
        </div>
    </div>

    <section class="Specializations">
        <div class="container">
            <ol>
                @foreach($specialization->topics as $topic)
                    <li>
                        <a href="{{ route('course.lessons', $topic->slug) }}">
                            {{ $topic->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
</x-general-layout>