<x-admin-layout class="Course">
    <x-admin-header 
        :header_title="$specialization->title . ' Topics'"
        :total_count="count($specialization->topics)"
        route="{{ route('topics.create') }}"
    />

    <div class="body">
        <ul>
            @if(count($specialization->topics) != 0)
                @php $id = 1 @endphp
                @foreach($specialization->topics as $topic)
                    <li class="searchable">
                        <span>
                            <a href="{{ route('topics.edit', $topic->id) }}">
                                {{ $topic->ordering }}
                            </a>
                        </span>
                        <span>
                            <a href="#">
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

    <x-slot name="javascript">
        <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    </x-slot>
</x-admin-layout>