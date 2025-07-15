<div class="AdminDashboard">
    <section class="Statistics">
        <div class="container">
            <div class="stats">
                @if(auth()->user()->isSuperAdmin())
                    <div class="stat">
                        <p>{{ $count_super_admins }}</p>
                        <p>{{ Str::plural('Super Admin', $count_super_admins) }} & {{ $count_users }} {{ Str::plural('User', $count_users) }}</p>
                    </div>
                @endif

                <div class="stat">
                    <p>{{ $count_admins }}</p>
                    <p>{{ Str::plural('Admin', $count_admins) }} & {{ $count_users }} {{ Str::plural('User', $count_users) }}</p>
                </div>

                <div class="stat">
                    <p>xxx</p>
                    <p>Courses</p>
                </div>

                <div class="stat">
                    <p>{{ $count_messages }}</p>
                    <p>{{ Str::plural('Message', $count_messages) }} & {{ $count_unread_messages }} Unread</p>
                </div>
            </div>
        </div>
    </section>
</div>
