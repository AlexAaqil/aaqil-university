<x-general-layout class="Course">
    <section class="Hero">
        <div class="container">
            <h1>{{ $course->title }} Specializations</h1>
        </div>
    </div>

    <section class="Specializations">
        <div class="container">
            <ol>
                @foreach($course->specializations as $specialization)
                    <li>
                        <a href="{{ route('course.topics', $specialization->slug) }}">
                            {{ $specialization->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
</x-general-layout>