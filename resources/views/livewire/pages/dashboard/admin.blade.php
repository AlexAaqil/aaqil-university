<div class="AdminDashboard">
    <section class="Statistics">
        <div class="container">
            <div class="stats">
                @if(auth()->user()->isSuperAdmin())
                    <div class="stat">
                        <p>{{ $count_super_admins }}</p>
                        <p>{{ Str::plural('Super Admin', $count_super_admins) }} & {{ $count_users }} {{ Str::plural('User', $count_users) }}</p>
                        <p class="extras">
                            <span>
                                {{ $count_admins }} {{ Str::plural('admin', $count_admins) }}
                            </span>
                        </p>
                    </div>
                @endif

                <div class="stat">
                    <p>{{ $count_all_users }}</p>
                    <p>{{ Str::plural('User', $count_all_users) }}</p>
                    <p class="extras">
                        <span>
                            {{ $count_admins }} {{ Str::plural('admin', $count_admins) }}
                        </span>
                    </p>
                </div>

                <div class="stat">
                    <p>{{ $count_courses }}</p>
                    <p>Courses</p>
                    <p class="extras">
                        <span>
                            {{ $count_draft_courses }} {{ Str::plural('draft', $count_draft_courses) }}
                        </span>
                    </p>
                </div>

                <div class="stat">
                    <p>{{ $count_messages }}</p>
                    <p>{{ Str::plural('Message', $count_messages) }}</p>
                    <p class="extras">
                        <span>
                            {{ $count_unread_messages }} unread
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>
