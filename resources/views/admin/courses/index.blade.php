<x-admin-layout class="Course">
    <x-admin-header 
        header_title="Courses"
        :total_count="count($courses)"
        route="{{ route('courses.create') }}"
    />

    <div class="body">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Visibility</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @if(count($courses) > 0)
                    @php $id = 1 @endphp
                    @foreach($courses as $course)
                        <tr>
                            <td>
                                <a href="{{ route('courses.edit', ['course' => $course->id]) }}">
                                    {{ $id++ }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('course-specializations.index', $course->slug) }}">
                                    {{ $course->title }}
                                </a>
                            </td>
                            <td>{{ $course->slug }}</td>
                            <td>{!! $course->visibility == 1 ? "<span><i class='fas fa-check green'></i></span>" : "<span><i class='fas fa-times danger'></i></span>" !!}</td>
                            <td class="actions">
                                <div class="action">
                                    <form id="deleteForm_{{ $course->id }}" action="{{ route('courses.destroy', ['course' => $course->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" onclick="deleteItem({{ $course->id }}, 'course');">
                                            <i class="fas fa-trash-alt delete"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">No data yet</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <x-slot name="javascript">
        <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    </x-slot>
</x-admin-layout>