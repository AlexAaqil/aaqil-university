<div class="related_pages_navbar">
    @foreach ($routes as $route)
        <a href="{{ route($route['name'], $route['params'] ?? []) }}">{{ $route['label'] }}</a>
    @endforeach
</div>