<x-admin-layout class="Course">
    <x-admin-header 
        :header_title="$specialization->title . ' Topics'"
        :total_count="count($specialization->topics)"
        route="{{ route('topics.create', $specialization->id) }}"
    />

    <div class="body">
        <ul class="custom_list" id="sortable">
            @if(count($specialization->topics) != 0)
                @php $id = 1 @endphp
                @foreach($specialization->topics as $topic)
                    <li class="searchable sortable_item" id="{{ $topic->id }}">
                        <span>
                            <a href="{{ route('topics.edit', ['topic' => $topic->id, 'specialization' => $specialization->id]) }}">
                                {{ $topic->ordering }}
                            </a>
                        </span>
                        <span>
                            <a href="{{ route('lessons.index', $topic->id) }}">
                                {{ $topic->title }}
                            </a>
                        </span>
                        <span class="actions">
                            <div class="action">
                                <form id="deleteForm_{{ $topic->id }}" action="{{ route('topics.destroy', $topic->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" onclick="deleteItem({{ $topic->id }}, 'specialization topic');">
                                        <i class="fas fa-trash-alt delete"></i>
                                    </button>
                                </form>
                            </div>
                        </span>
                    </li>
                @endforeach
            @else
                <span>No topics yet</span>
            @endif
        </ul>
    </div>

    <x-courses-js url="{{ route('topics.sort') }}" />
</x-admin-layout>