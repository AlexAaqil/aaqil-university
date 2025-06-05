<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\General\Index as HomePage;
use App\Livewire\Pages\General\About;
use App\Livewire\Pages\General\Contact\Index as ContactPage;

Route::get('/', HomePage::class)->name('home-page');
Route::get('about', About::class)->name('about-page');
Route::get('contact', ContactPage::class)->name('contact-page');
