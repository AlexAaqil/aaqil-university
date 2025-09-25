# TODOs
- course specializations edit page.
- course specializations unselect checkboxes on the add page.

fill content for
- Web Development



# DB Design
```
users {
    id();
    uuid('uuid')->unique();
    string('first_name');
    string('last_name');
    string('username')->nullable();
    string('email')->unique();
    string('phone_number')->nullable();
    string('secondary_phone_number')->nullable();
    unsignedTinyInteger('role')->default(3)->index();
    boolean('status')->default(true)->index();
    string('image')->nullable();
    string('bio')->nullable();
    string('location')->nullable();
    unsignedTinyInteger('profile_completion_score')->nullable();
    json('settings')->nullable(); // preferred_language, theme, notification_preferences, learning_goals
    timestamp('last_login_at')->nullable();
    unsignedTinyInteger('learning_streak_days')->nullable();
    unsignedSmallInteger('points')->nullable();
    timestamp('email_verified_at')->nullable();
    string('password');
    rememberToken();
    timestamps();
}

contact_messages {
    id();
    uuid('uuid')->unique();
    string('name');
    string('email');
    string('phone_number');
    string('message', 2000);
    string('response', 2000)->nullable();
    string('notes')->nullable();
    boolean('is_read')->default(false)->index();
    boolean('is_important')->default(false)->index();
    timestamps();
}

courses {
    id();
    uuid('uuid')->unique();
    string('title')->unique();
    string('slug')->unique();
    string('description');
    string('image')->nullable();
    boolean('is_published')->default(true)->index;
    unsignedTinyInteger('difficulty_level')->nullable()->index();
    unsignedSmallInteger('estimated_duration_minutes')->nullable();
    string('intro_video_url')->nullable();
    json('tags')->nullable(); // to make the content searchable such as python, frontend.

    foreignId('created_by')->nullable()->constrained('users')->nullOnDelete()->index();
    timestamps();
}

specializations {
    id();
    uuid('uuid')->unique();
    string('title')->unique();
    string('slug')->unique();
    timestamps();
}

#[pivot]
course_specialization {
    id();
    foreignId('course_id')->index()->constrained('courses')->cascadeOnDelete();
    foreignId('specialization_id')->index()->constrained('specializations')->cascadeOnDelete();
    unsignedInteger('sort_order')->nullable()->index();
    unique(['course_id', 'specialization_id']);
}

topics {
    id();
    uuid('uuid')->unique();
    string('title');
    string('description')->nullable();
    string('slug')->unique();
    unsignedInteger('sort_order')->nullable()->index();
    boolean('is_locked')->default(false)->index(); // to help gate behind premium/progress

    foreignId('specialization_id')->constrained('specializations')->cascadeOnDelete()->index();
    timestamps();
}

lessons {
    id();
    uuid('uuid')->unique();
    string('title');
    string('slug')->unique();
    unsignedInteger('sort_order')->nullable()->index();
    unsignedSmallInteger('estimated_duration_minutes')->nullable();
    json('resource_links')->nullable();

    foreignId('topic_id')->constrained('topics')->cascadeOnDelete()->index();
    timestamps();
}

sections {
    id();
    uuid('uuid')->unique();
    string('title');
    string('slug')->unique();
    text('content');
    unsignedInteger('sort_order')->nullable()->index();

    foreignId('lesson_id')->constrained('lessons')->cascadeOnDelete()->index();
    timestamps();
}

quizzes {
    $table->id();
    $table->string('title');

    $table->foreignId('lesson_id')->nullable()->constrained()->cascadeOnDelete()->index();
    $table->foreignId('topic_id')->nullable()->constrained()->cascadeOnDelete()->index();
    $table->timestamps();
}

questions {
    $table->id();
    $table->text('question_text');
    $table->json('options'); // store as: ["A", "B", "C", "D"]
    $table->string('correct_answer'); // "A"

    $table->foreignId('quiz_id')->constrained()->cascadeOnDelete()->index();
    $table->timestamps();
}

enrollments {
    $table->id();

    $table->foreignId('user_id')->constrained()->cascadeOnDelete()->index();
    $table->foreignId('course_id')->constrained()->cascadeOnDelete()->index();
    $table->timestamps();
}

content_scripts {
    id();
    string('title')->unique();
    text('content');
    unsignedTinyInteger('category')->index();
    unsignedInteger('sort_order')->nullable()->index();
    boolean('is_published')->default(false)->index();
    timestamps();
}
```

# ENUMS
```
USER_ROLES: int
{
    SUPER_ADMIN = 0;
    ADMIN = 1;
    OWNER = 2;
    USER = 3;
}

COURSE_DIFFICULTY_LEVELS: int
{
    BEGINNER = 0;
    INTERMEDIATE = 1;
    ADVANCED = 2;
}

CONTENT_SCRIPT_CATEGORIES: int {
    CYBER_SECURITY = 0;
    WEB_DEVELOPMENT = 1;
}
```
