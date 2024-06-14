<x-admin-layout class="Course">
    <x-admin-header 
        :header_title="$lesson->title . ' Sections'"
        :total_count="count($lesson->sections)"
        route="{{ route('sections.create', $lesson->id) }}"
    />

    <div class="body">
        <ul>
            @if(count($lesson->sections) != 0)
                @php $id = 1 @endphp
                @foreach($lesson->sections as $section)
                    <li class="searchable">
                        <span>
                            <a href="{{ route('sections.edit', ['section' => $section->id, 'lesson' => $lesson->id]) }}">
                                {{ $section->ordering }}
                            </a>
                        </span>
                        <span class="section_content">
                            <h1>{{ $section->title }}</h1>
                            {!! $section->content !!}
                        </span>
                        <span class="actions">
                            <div class="action">
                                <form id="deleteForm_{{ $section->id }}" action="{{ route('sections.destroy', $section->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" class="btn_delete" onclick="deleteItem({{ $section->id }}, 'section');">
                                        <i class="fas fa-trash-alt delete"></i>
                                    </button>
                                </form>
                            </div>
                        </span>
                    </li>
                    <hr>
                @endforeach
            @else
                <span>No sections yet</span>
            @endif
        </ul>
    </div>

    <x-slot name="javascript">
        <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    </x-slot>
</x-admin-layout>