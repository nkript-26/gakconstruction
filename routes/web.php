<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

// Home Page
Route::get('/', [PageController::class, 'home'])->name('home');

// About Page
Route::get('/about', [PageController::class, 'about'])->name('about');

// Services Page
Route::get('/services', [PageController::class, 'services'])->name('services');

// Projects Page
Route::get('/projects', [PageController::class, 'projects'])->name('projects');

// Contact Page
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Contact Form Submit
Route::post('/contact', [PageController::class, 'contactSubmit'])->name('contact.submit');