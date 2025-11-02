<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\Admin\GameAdminController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\PlaySessionController;
use App\Http\Controllers\ReviewController;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});


Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profiel (auth vereist)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Games alleen voor ingelogde (en evt. geverifieerde) users
Route::middleware(['auth','verified'])->group(function () {
    Route::get('/games', [GameController::class, 'index'])->name('games.index');
    Route::get('/games/{game}', [GameController::class, 'show'])->name('games.show');
    Route::post('/games/{game}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/games/{game}/played', [PlaySessionController::class, 'store'])
        ->name('playsessions.store');

    Route::patch('/reviews/{review}', [ReviewController::class, 'update'])
    ->middleware('can:update,review')
    ->name('reviews.update');

    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])
        ->middleware('can:delete,review')
        ->name('reviews.destroy');
});

// ADMIN (auth + verified + role:admin)
Route::prefix('admin')
    ->middleware(['auth', 'verified', RoleMiddleware::class . ':admin'])
    ->group(function () {
        // Admin dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Admin games beheer
        Route::get('/games', [GameAdminController::class, 'index'])->name('admin.games.index');
        Route::post('/games/{game}/toggle-active',   [GameAdminController::class, 'toggleActive'])->name('admin.games.toggleActive');
        Route::post('/games/{game}/toggle-featured', [GameAdminController::class, 'toggleFeatured'])->name('admin.games.toggleFeatured');
    });

require __DIR__.'/auth.php';
