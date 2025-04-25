# DB Design
```
users {
    id();
    string('first_name');
    string('last_name');
    string('email')->unique();
    string('phone_number')->nullable();
    string('secondary_phone_number')->nullable();
    unsignedTinyInteger('user_level')->default(4);
    unsignedTinyInteger('user_status')->default(1);
    string('image')->nullable();
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
```

# ENUMS
```
enum UserStatus: int
{    
    case INACTIVE = 0;
    case ACTIVE = 1;
    case BANNED = 2;
}

enum UserLevel: int
{    
    case SUPERADMIN = 0;
    case ADMIN = 1;
    case OWNER = 2;
    case USER = 3;
}
```
