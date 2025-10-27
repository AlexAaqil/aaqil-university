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
Route::get('courses/{slug}/specializations', Specializations::class)->name('course.specializations');
Route::get('courses/{course}/{specialization}/topics', Topics::class)->name('course.topics');
Route::get('courses/{course}/{specialization}/{topic}/lessons', Lessons::class)->name('course.lessons');

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

        Route::get('courses', CoursesIndex::class)->name('admin.courses.index');
        Route::get('courses/create', [CourseController::class, 'create'])->name('admin.courses.create');
        Route::post('courses', [CourseController::class, 'store'])->name('admin.courses.store');
        Route::get('courses/{course}/edit', [CourseController::class, 'edit'])->name('admin.courses.edit');
        Route::patch('courses/{course}', [CourseController::class, 'update'])->name('admin.courses.update');

        Route::get('courses/{course:slug}/specializations', CourseSpecializationsIndex::class)->name('admin.course.specializations.index');
        Route::get('courses/{course:slug}/specializations/create', [SpecializationController::class, 'create'])->name('admin.course.specializations.create');
        Route::post('courses/{course:slug}/specializations', [SpecializationController::class, 'store'])->name('admin.course.specializations.store');
        Route::get('courses/{course:slug}/specializations/{specialization:slug}/edit', [SpecializationController::class, 'edit'])->name('admin.course.specializations.edit');
        Route::patch('courses/{course:slug}/specializations/{specialization:slug}', [SpecializationController::class, 'update'])->name('admin.course.specializations.update');

        Route::get('courses/{course:slug}/{specialization:slug}/topics', TopicsIndex::class)->name('admin.specialization.topics.index');
        Route::get('courses/{course:slug}/{specialization:slug}/topics/create', [TopicController::class, 'create'])->name('admin.specialization.topics.create');
        Route::post('courses/{course:slug}/{specialization:slug}/topics', [TopicController::class, 'store'])->name('admin.specialization.topics.store');
        Route::get('courses/{course:slug}/{specialization:slug}/topics/edit', [TopicController::class, 'edit'])->name('admin.specialization.topics.edit');
        Route::patch('courses/{course:slug}/{specialization:slug}/topics', [TopicController::class, 'update'])->name('admin.specialization.topics.update');

        Route::get('courses/{course}/{specialization}/{topic}/lessons', LessonsIndex::class)->name('admin.topic.lessons.index');
        Route::get('courses/{course}/{specialization}/{topic}/lessons/create', [LessonController::class, 'create'])->name('admin.topic.lessons.create');
        Route::post('courses/{course}/{specialization}/{topic}/lessons', [LessonController::class, 'store'])->name('admin.topic.lessons.store');
        Route::get('courses/{course}/{specialization}/{topic}/lessons/edit', [LessonController::class, 'edit'])->name('admin.topic.lessons.edit');
        Route::patch('courses/{course}/{specialization}/{topic}/lessons', [LessonController::class, 'update'])->name('admin.topic.lessons.update');

        Route::get('courses/{course}/{specialization}/{topic}/{lesson}/sections', SectionsIndex::class)->name('admin.lesson.sections.index');
        Route::get('courses/{course}/{specialization}/{topic}/{lesson}/sections/create', [SectionController::class, 'create'])->name('admin.lesson.sections.create');
        Route::post('courses/{course}/{specialization}/{topic}/{lesson}/sections', [SectionController::class, 'store'])->name('admin.lesson.sections.store');
        Route::get('courses/{course}/{specialization}/{topic}/{lesson}/sections/edit', [SectionController::class, 'edit'])->name('admin.lesson.sections.edit');
        Route::patch('courses/{course}/{specialization}/{topic}/{lesson}/sections', [SectionController::class, 'update'])->name('admin.lesson.sections.update');
    });
});

require __DIR__ . '/auth.php';
