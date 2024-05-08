<x-general-layout class="HomePage">
    <section class="Hero">
        <div class="container">
            <div class="text">
                <h1>LEARNING THAT SETS YOU UP FOR THE REAL WORLD</h1>
                <div class="hero_btn">
                    <a href="{{ route('courses') }}">Start Learning</a>
                </div>
            </div>

            <div class="image">
                <img src="{{ asset('assets/images/aaqil-university-hero.jpg') }}" alt="Aaqil University Hero Image">
            </div>
        </div>
    </section>

    <section class="About">
        <div class="container">
            <p>Aaqil university is based in Kiambu and focuses on helping novices grow to senior developers. We believe in learning by building real world projects that help you gain experience as well as the ability to adapt to any environment.</p>
        </div>
    </section>
</x-general-layout>