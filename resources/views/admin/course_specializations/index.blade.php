<x-admin-layout class="Course_specializations">
    <x-admin-header 
        :header_title="$course->title . ' Specializations'"
        :total_count="count($course->specializations)"
        route="{{ route('course-specializations.create') }}"
    />

    <div class="body">
        <ul>
            @if(count($course->specializations) != 0)
                @php $id = 1 @endphp
                @foreach($course->specializations as $specialization)
                    <li class="searchable">
                        <span>
                            <a href="{{ route('course-specializations.edit', $specialization->id) }}">
                                {{ $specialization->pivot->ordering }}
                            </a>
                        </span>
                        <span>{{ $specialization->title }}</span>
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
    </div>

    <x-slot name="javascript">
        <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    </x-slot>
</x-admin-layout>