<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GeneralPagesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\TopicController;

Route::get('/', [GeneralPagesController::class, 'home'])->name('home');
Route::get('/about', [GeneralPagesController::class, 'about'])->name('about');
Route::get('/courses', [GeneralPagesController::class, 'courses'])->name('courses');
Route::get('/course/{slug}/specializations', [GeneralPagesController::class, 'course_specializations'])->name('course_specializations');
Route::get('/specialization/{specialization}/topics', [GeneralPagesController::class, 'specialization_topics'])->name('specialization_topics');
Route::get('/contact', [GeneralPagesController::class, 'contact'])->name('contact');
Route::post('/contact', [CommentController::class, 'store'])->name('comments.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified', 'admin'])
->prefix('admin')
->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'admin_dashboard'])->name('admin.dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::resource('courses', CourseController::class)->except('show');

    Route::get('/specializations/{course}', [SpecializationController::class, 'index'])->name('course-specializations.index');
    Route::resource('course-specializations', SpecializationController::class)->except('index', 'show');

    Route::resource('topics', TopicController::class)->except('index', 'show');
    Route::get('/topics/{specialization}', [TopicController::class, 'index'])->name('topics.index');
    
    Route::resource('comments', CommentController::class)->only('index', 'edit', 'update', 'destroy');
});
