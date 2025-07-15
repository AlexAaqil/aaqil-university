<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Scripts / Styles -->
        @vite(['resources/css/guest-layout.css'])

        @isset($extra_head)
            {{ $extra_head }}
        @else
            <title>Aaqil University</title>
        @endisset
    </head>
    <body class="antialiased font-sans">
        <livewire:partials.navbar />

        <main class="guest_layout">
            {{ $slot }}
        </main>

        <livewire:partials.footer />

        @isset($javascript)
            {{ $javascript }}
        @endisset
    </body>
</html>
