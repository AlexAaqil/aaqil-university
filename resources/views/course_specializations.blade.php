<x-general-layout class="Courses_specializations">
    <section class="Hero">
        <div class="container">
            <h1>{{ $course->title }}</h1>
        </div>
    </div>

    <section class="Specializations">
        <div class="container">
            <ol>
                @foreach($course->specializations as $specialization)
                    <li>{{ $specialization->title }}</li>
                @endforeach
            </ul>
        </div>
    </section>
</x-general-layout>