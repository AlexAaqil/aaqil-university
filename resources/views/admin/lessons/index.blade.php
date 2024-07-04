<x-admin-layout class="Course">
    <div class="related_pages">
        <a href="{{ route('topics.index', $topic->specialization->id) }}">Topic</a>
        <span>Lessons</span>
    </div>

    <x-admin-header 
        :header_title="$topic->title . ' Lessons'"
        :total_count="count($topic->lessons)"
        route="{{ route('lessons.create', $topic->id) }}"
    />

    <div class="body">
        <div class="contents">
            <ul class="custom_list" id="sortable">
                @if(count($topic->lessons) != 0)
                    @php $id = 1 @endphp
                    @foreach($topic->lessons as $lesson)
                        <li class="searchable sortable_item" id="{{ $lesson->id }}">
                            <span>
                                <a href="{{ route('lessons.edit', ['lesson' => $lesson->id, 'topic' => $topic->id]) }}">
                                    {{ $lesson->ordering }}
                                </a>
                            </span>
                            <span>
                                <a href="{{ route('sections.index', $lesson->id) }}">
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
    </div>
    
    <x-courses-js url="{{ route('lessons.sort') }}" />
</x-admin-layout>