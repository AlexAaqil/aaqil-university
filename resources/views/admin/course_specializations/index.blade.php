<x-admin-layout class="Course_specializations">
    <x-courses-navbar />

    <x-admin-header 
        header_title="Course Specializations"
        :total_count="count($course_specializations)"
        route="{{ route('course-specializations.create') }}"
    />

    <div class="body">
        @foreach($courses as $course)
            <h2>
                {!! 
                    $course->visibility == 1 ? $course->title : '<i class="greyed">' . $course->title . '</i>' 
                !!} 
                <span>{{ count($course->specializations) }}</span>
            </h2>
            <ul>
                @if(count($course->specializations) != 0)
                    @foreach($course->specializations as $specialization)
                        <li class="searchable">
                            <span>
                                <a href="{{ route('course-specializations.edit', $specialization->id) }}">
                                    {{ $specialization->title }}
                                </a>
                            </span>
                            <span>{{ $specialization->ordering }}</span>
                            <span class="actions">
                                <div class="action">
                                    <form id="deleteForm_{{ $specialization->id }}" action="{{ route('course-specializations.destroy', ['course_specialization' => $specialization->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" onclick="deleteItem({{ $specialization->id }}, 'course specialization');">
                                            <i class="fas fa-trash-alt delete"></i>
                                        </button>
                                    </form>
                                </div>
                            </span>
                        </li>
                    @endforeach
                @else
                    <span>No specializations yet</span>
                @endif
            </ul>
        @endforeach
    </div>

    <x-slot name="javascript">
        <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    </x-slot>
</x-admin-layout>