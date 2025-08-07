<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\General\Index as HomePage;
use App\Livewire\Pages\General\About;
use App\Livewire\Pages\General\Contact\Index as ContactPage;
use App\Livewire\Pages\General\Courses\Index as Courses;
use App\Livewire\Pages\General\Courses\Specializations;
use App\Livewire\Pages\General\Courses\Topics;
use App\Livewire\Pages\General\Courses\Lessons;
use App\Livewire\Pages\ContactMessages\Index as ContactMessages;
use App\Livewire\Pages\ContactMessages\Edit as EditContactMessages;

use App\Livewire\Pages\Dashboard\Index as Dashboard;

use App\Livewire\Pages\Users\Index as Users;
use App\Livewire\Pages\Users\Form as CreateUser;
use App\Livewire\Pages\Users\Form as EditUser;
use App\Livewire\Pages\Courses\Courses\Index as CoursesIndex;
use App\Http\Controllers\Courses\CourseController;
use App\Livewire\Pages\Courses\Specializations\Index as CourseSpecializationsIndex;
use App\Http\Controllers\Courses\SpecializationController;
use App\Livewire\Pages\Courses\Topics\Index as TopicsIndex;
use App\Http\Controllers\Courses\TopicController;
use App\Livewire\Pages\Courses\Lessons\Index as LessonsIndex;
use App\Http\Controllers\Courses\LessonController;
use App\Livewire\Pages\Courses\Sections\Index as SectionsIndex;
use App\Http\Controllers\Courses\SectionController;

Route::get('/', HomePage::class)->name('home-page');
Route::get('about', About::class)->name('about-page');
Route::get('contact', ContactPage::class)->name('contact-page');

Route::get('courses', Courses::class)->name('courses');
Route::get('course-specializations/{slug}', Specializations::class)->name('course.specializations');
Route::get('specialization-topics/{specialization}', Topics::class)->name('course.topics');
Route::get('topic-lessons/{topic}', Lessons::class)->name('course.lessons');

Route::middleware(['authenticated_user'])->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
});

Route::middleware(['admin_only'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('users', Users::class)->name('users.index');
        Route::get('users/create', CreateUser::class)->name('users.create');
        Route::get('users/{uuid}/edit', EditUser::class)->name('users.edit');

        Route::get('messages', ContactMessages::class)->name('contact-messages.index');
        Route::get('messages/{message}/edit', EditContactMessages::class)->name('contact-messages.edit');

        Route::get('courses', CoursesIndex::class)->name('courses.index');
        Route::get('courses/create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('courses', [CourseController::class, 'store'])->name('courses.store');
        Route::get('courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        Route::patch('courses/{course}', [CourseController::class, 'update'])->name('courses.update');

        Route::get('course-specializations/{course}', CourseSpecializationsIndex::class)->name('course-specializations.index');
        Route::get('course-specializations/create/{course}', [SpecializationController::class, 'create'])->name('course-specializations.create');
        Route::post('course-specializations', [SpecializationController::class, 'store'])->name('course-specializations.store');
        Route::get('course-specializations/{course}/edit', [SpecializationController::class, 'edit'])->name('course-specializations.edit');
        Route::patch('course-specializations/{course}', [SpecializationController::class, 'update'])->name('course-specializations.update');

        Route::get('specialization-topics/{specialization}', TopicsIndex::class)->name('specialization-topics.index');
        Route::get('specialization-topics/create/{specialization}', [TopicController::class, 'create'])->name('specialization-topics.create');
        Route::post('specialization-topics', [TopicController::class, 'store'])->name('specialization-topics.store');
        Route::get('specialization-topics/{topic}/{specialization}/edit', [TopicController::class, 'edit'])->name('specialization-topics.edit');
        Route::patch('specialization-topics/{topic}/{specialization}', [TopicController::class, 'update'])->name('specialization-topics.update');

        Route::get('topic-lessons/{topic}', LessonsIndex::class)->name('topic-lessons.index');
        Route::get('topic-lessons/create/{topic}', [LessonController::class, 'create'])->name('topic-lessons.create');
        Route::post('topic-lessons', [LessonController::class, 'store'])->name('topic-lessons.store');
        Route::get('topic-lessons/{lesson}/{topic}/edit', [LessonController::class, 'edit'])->name('topic-lessons.edit');
        Route::patch('topic-lessons/{lesson}/{topic}', [LessonController::class, 'update'])->name('topic-lessons.update');

        Route::get('lesson-sections/{lesson}', SectionsIndex::class)->name('lesson-sections.index');
        Route::get('lesson-sections/create/{lesson}', [SectionController::class, 'create'])->name('lesson-sections.create');
        Route::post('lesson-sections', [SectionController::class, 'store'])->name('lesson-sections.store');
        Route::get('lesson-sections/{section}/{lesson}/edit', [SectionController::class, 'edit'])->name('lesson-sections.edit');
        Route::patch('lesson-sections/{section}/{lesson}', [SectionController::class, 'update'])->name('lesson-sections.update');
    });
});

require __DIR__ . '/auth.php';
