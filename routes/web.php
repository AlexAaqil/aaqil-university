<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\General\Index as HomePage;
use App\Livewire\Pages\General\About;
use App\Livewire\Pages\General\Contact\Index as ContactPage;
use App\Livewire\Pages\General\Courses\Index as Courses;
use App\Livewire\Pages\General\Courses\Specializations;

Route::get('/', HomePage::class)->name('home-page');
Route::get('about', About::class)->name('about-page');
Route::get('contact', ContactPage::class)->name('contact-page');

Route::get('courses', Courses::class)->name('courses');
Route::get('course-specializations/{slug}', Specializations::class)->name('course.specializations');
// Route::get('/specialization/{specialization}/topics', [GeneralPagesController::class, 'topics'])->name('course.topics');
// Route::get('/lessons/{topic}', [GeneralPagesController::class, 'lessons'])->name('course.lessons');
