<x-admin-layout class="Courses_categories">
    <x-admin-header 
        header_title="Course Categories"
        :total_count="count($course_categories)"
        route="{{ route('course-categories.create') }}"
    />

    <div class="body">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @if(count($course_categories) > 0)
                    @php $id = 1 @endphp
                    @foreach($course_categories as $course_category)
                        <tr>
                            <td>
                                <a href="{{ route('course-categories.edit', ['course_category' => $course_category->id]) }}">
                                    {{ $id++ }}
                                </a>
                            </td>
                            <td>{{ $course_category->title }}</td>
                            <td>{{ $course_category->slug }}</td>
                            <td class="actions">
                                <div class="action">
                                    <form id="deleteForm_{{ $course_category->id }}" action="{{ route('course-categories.destroy', ['course_category' => $course_category->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" onclick="deleteItem({{ $course_category->id }}, 'course category');">
                                            <i class="fas fa-trash-alt delete"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5"></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <x-slot name="javascript">
        <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    </x-slot>
</x-admin-layout>