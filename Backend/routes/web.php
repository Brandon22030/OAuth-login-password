<?php

use App\Http\Controllers\loginController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

// GITHUB
    Route::get('login/github', [loginController::class, 'redirectToGithub'])->name('github.login');

    Route::get('login/github/callback', [loginController::class, 'handleGithubCallback']);

// GOOGLE
    Route::get('/login/google', [loginController::class, 'redirectToGoogle'])->name('google.login');

    Route::get('/login/google/callback', [loginController::class, 'handleGoogleCallback']);

// LINKEDIN
    Route::get('/login/linkedin', [loginController::class, 'redirectToLinkedin'])->name('linkedin.login');

    Route::get('/login/linkedin/callback', [loginController::class, 'handleLinkedinCallback']);