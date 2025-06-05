# DB Design
```
users {
    id();
    string('first_name');
    string('last_name');
    string('email')->unique();
    string('phone_number')->nullable();
    string('secondary_phone_number')->nullable();
    unsignedTinyInteger('role')->default(4);
    unsignedTinyInteger('status')->default(1);
    string('avatar')->nullable();
    string('password');
    timestamp('email_verified_at')->nullable();

    rememberToken();
    timestamps();
}

courses {
    id();
    string('title')->unique();
    string('slug');
    string('description');
    string('image')->nullable();
    boolean('visibility')->default(1);

    foreginId('created_by')->nullable()->constrained('users')->nullOnDelete();
    timestamps();
}

specializations {
    id();
    string('title')->unique();
    string('slug');
}

#[pivot]
course_specialization {
    id();
    foreignId('course_id')->index()->constrained('courses')->cascadeOnDelete();
    foreignId('specialization_id')->index()->constrained('specializations')->cascadeOnDelete();
    unsignedInteger('sort_order')->nullable();

    unique(['course_id', 'specialization_id']);
}

specialization_topics {
    id();
    string('title');
    string('slug');
    unsignedInteger('sort_order')->nullable();

    foreignId('specialization_id')->constrained('specializations')->cascadeOnDelete();
    timestamps();
}

lessons {
    id();
    string('title');
    string('slug');
    unsignedInteger('sort_order')->nullable();

    foreignId('specialization_topic_id')->constrained('specialization_topics')->cascadeOnDelete();
    timestamps();
}

sections {
    id();
    string('title');
    string('slug');
    string('content');
    unsignedInteger('sort_order')->nullable();

    foreignId('lesson_id')->constrained('lessons')->cascadeOnDelete();
    timestamps();
}

quizes {
    $table->id();
    $table->string('title');
    $table->foreignId('lesson_id')->nullable()->constrained()->onDelete('cascade');
    $table->foreignId('topic_id')->nullable()->constrained()->onDelete('cascade');
    $table->timestamps();
}

questions {
    $table->id();
    $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
    $table->text('question_text');
    $table->json('options'); // store as: ["A", "B", "C", "D"]
    $table->string('correct_answer'); // "A"
    $table->timestamps();
}

enrollments {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('course_id')->constrained()->onDelete('cascade');
    $table->timestamps();
}

content_scripts {
    id();
    string('title')->unique();
    text('content');
    unsignedInteger('sort_order')->nullable();
    boolean(is_published)->default(false);
    unsignedTinyInteger('category');
    timestamps();
}
```

# ENUMS
```
enum UserStatus: int
{    
    INACTIVE = 0;
    ACTIVE = 1;
    BANNED = 2;
}

enum UserLevel: int
{    
    SUPERADMIN = 0;
    ADMIN = 1;
    OWNER = 2;
    USER = 3;
}

enum content_scripts_categories {
    CYBER_SECURITY = 0;
    WEB_DEVELOPMENT = 0;
}
```
