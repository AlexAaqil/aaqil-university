<x-general-layout class="AboutPage">
    <section class="Hero">
        <div class="container">
            <p>Aaqil University's mission is to inspire people to achieve their goals in Science, Technology and Maths.</p>
            <p>We use small chanks of simplified learning experiences to help you learn and build amazing projects that help you discover what professionals in the industry are doing so you have a strong foundation for your career.</p>
        </div>
    </section>

    <section class="Team">
        <div class="container">
            <h1>Team</h1>
            <div class="team_members">
                @foreach($users as $user)
                    <div class="team_member">
                        <div class="image">
                            <img src="{{ asset('assets/images/default_profile.jpg') }}" alt="Profile Picture">
                        </div>

                        <div class="text">
                            <h1>{{ $user->first_name . ' ' . $user->last_name }}</h1>
                            <p>{{ $user->user_level }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-general-layout>