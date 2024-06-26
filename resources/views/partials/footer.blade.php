<footer>
    <div class="container">
        <div class="branding">
            <div class="image">
                <x-app-logo />
            </div>
            <h1>{{ env('APP_NAME') }}</h1>
            <p>Learn Build Repeat</p>
        </div>

        <div class="links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('courses') }}">Courses</a>
            <a href="{{ route('contact') }}">Contact</a>
        </div>

        <div class="contacts">
            <div class="details">
                <p>{{ config('app.phone_number') }}</p>
                <p>aaqiluniversity@gmail.com</p>
            </div>
        </div>
    </div>

    <p class="copyright">&copy; 2023 | All rights reserved</p>
</footer>