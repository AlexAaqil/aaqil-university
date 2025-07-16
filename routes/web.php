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
    });
});

require __DIR__ . '/auth.php';
