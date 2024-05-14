<x-slot name="javascript">
    @if (App::environment('production') && @fsockopen('www.google.com', 80))
        <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/super-build/ckeditor.js"></script>
    @else
        <script src="{{ asset('assets/js/ckeditor.js') }}"></script>
    @endif

    <script src="{{ asset('assets/js/ckeditor_customization.js') }}"></script>
</x-slot>