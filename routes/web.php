<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionActivateController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SubscriptionDeactivateController;
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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('subscriptions', SubscriptionController::class);
    Route::patch('subscriptions/{subscription}/activate', SubscriptionActivateController::class);
    Route::patch('subscriptions/{subscription}/deactivate', SubscriptionDeactivateController::class);
});

require __DIR__.'/auth.php';
