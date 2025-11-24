<div class="HomePage">
    <section class="Hero">
        <div class="container">
            <div class="text">
                <h1>Transform Your Future with Real-World Tech Education</h1>
                <p>Master in-demand development skills through project-based learning and industry-aligned curriculum</p>
                <div class="hero_btn">
                    <a href="{{ Route::has('courses') ? route('courses') : '#' }}">Start Learning</a>
                </div>
            </div>

            <div class="image">
                <img src="{{ asset('assets/images/aaqil-university-hero.jpg') }}" alt="Aaqil University Hero Image">
            </div>
        </div>
    </section>

    <section class="About">
        <div class="container">
            <p>Based in Kiambu, Aaqil university bridges the gap between academia and industry. Our project-based approach transforms beginners into senior-level developers through immersive, real-world training. We don't just teach code—we cultivate adaptable problem-solvers ready for any tech environment.</p>
        </div>
    </section>
</div>
