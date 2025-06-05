<div class="AboutPage">
    @php
        $users = [
            ['first_name' => 'Alex', 'last_name' => 'Wambui', 'user_level' => 'Founder'],
        ];
    @endphp
    <section class="Hero">
        <div class="container">
            <p>Aaqil University's mission is to inspire people to achieve their goals in Science, Technology and Maths.</p>
            <p>We use small chanks of simplified learning experiences to help you learn and build amazing projects that help you discover what professionals in the industry are doing so you have a strong foundation for your career.</p>
        </div>
    </section>

    <section class="About">
        <div class="container">
            <p>It seems like every other day, there's a new technology to learn, tool to master and endless articles to read. Honestly, it can be overwhelming and intimidating. So whether you're new or just need some guidance and support, Aaqil University is here to help.</p>

            <h2>Why choose us?</h2>
            <p>We just strive to function as a catalyst and challenge you to grow as both a developer and a human. We care about the details and will encourage you to think, plan and dream.</p>
            

            <h2>Benefits</h2>
            <div class="benefits">
                <div class="benefit">
                    <p>Resources</p>
                    <p>We'll point you towards informative content to learn from.</p>
                </div>

                <div class="benefit">
                    <p>Networking</p>
                    <p>You'll get connected with other pros to expand your reach.</p>
                </div>

                <div class="benefit">
                    <p>Opportunity</p>
                    <p>You'll be introduced and helped to source potential work.</p>
                </div>

                <div class="benefit">
                    <p>Growth</p>
                    <p>We'll uncover blindspots and accelerate your growth.</p>
                </div>
            </div>
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
                            <h1>{{ $user['first_name'] . ' ' . $user['last_name'] }}</h1>
                            <p>{{ $user['user_level'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
