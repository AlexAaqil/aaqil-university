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
use App\Http\Controllers\LessonController;
use App\Http\Controllers\SectionController;

Route::get('/', [GeneralPagesController::class, 'home'])->name('home');
Route::get('/about', [GeneralPagesController::class, 'about'])->name('about');

Route::get('/courses', [GeneralPagesController::class, 'courses'])->name('courses');
Route::get('/course/{slug}/specializations', [GeneralPagesController::class, 'specializations'])->name('course.specializations');
Route::get('/specialization/{specialization}/topics', [GeneralPagesController::class, 'topics'])->name('course.topics');
Route::get('/lessons/{topic}', [GeneralPagesController::class, 'lessons'])->name('course.lessons');

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

    Route::get('/topics/create/{specialization}', [TopicController::class, 'create'])->name('topics.create');
    Route::get('/topics/edit/{topic}/{specialization}', [TopicController::class, 'edit'])->name('topics.edit');
    Route::resource('topics', TopicController::class)->except('index', 'show', 'create', 'edit');
    Route::get('/topics/{specialization}', [TopicController::class, 'index'])->name('topics.index');
    Route::post('/topics/sort-topics', [TopicController::class, 'sort_topics'])->name('topics.sort');

    Route::get('/lessons/create/{topic}', [LessonController::class, 'create'])->name('lessons.create');
    Route::resource('lessons', LessonController::class)->except('index', 'show', 'create');
    Route::get('/lessons/{topic}', [LessonController::class, 'index'])->name('lessons.index');
    Route::post('/lessons/sort-lessons', [LessonController::class, 'sort_lessons'])->name('lessons.sort');

    Route::resource('sections', SectionController::class)->except('index', 'show');
    Route::get('/sections/{lesson}', [SectionController::class, 'index'])->name('sections.index');
    
    Route::resource('comments', CommentController::class)->only('index', 'edit', 'update', 'destroy');
});
