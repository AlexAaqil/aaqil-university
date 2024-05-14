<x-admin-layout class="Course">
    <x-admin-header 
        :header_title="$topic->title . ' Lessons'"
        :total_count="count($topic->lessons)"
        route="{{ route('lessons.create') }}"
    />

    <div class="body">
        <ul>
            @if(count($topic->lessons) != 0)
                @php $id = 1 @endphp
                @foreach($topic->lessons as $lesson)
                    <li class="searchable">
                        <span>
                            <a href="{{ route('lessons.edit', $lesson->id) }}">
                                {{ $lesson->ordering }}
                            </a>
                        </span>
                        <span>
                            <a href="{{ route('sections.index', $lesson->slug) }}">
                                {{ $lesson->title }}
                            </a>
                        </span>
                        <span class="actions">
                            <div class="action">
                                <form id="deleteForm_{{ $lesson->id }}" action="{{ route('lessons.destroy', $lesson->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" onclick="deleteItem({{ $lesson->id }}, 'lesson');">
                                        <i class="fas fa-trash-alt delete"></i>
                                    </button>
                                </form>
                            </div>
                        </span>
                    </li>
                @endforeach
            @else
                <span>No lessons yet</span>
            @endif
        </ul>
    </div>

    <x-slot name="javascript">
        <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    </x-slot>
</x-admin-layout>