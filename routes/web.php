<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\HistoriesController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\EventController as UserEventController;
use App\Http\Controllers\User\OrderController;
use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Public Event Detail
Route::get('/events/{event}', [UserEventController::class, 'show'])->name('events.show');

Route::middleware('auth')->group(function () {

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Orders (User)
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

    // Admin Routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Category Management
        Route::resource('categories', CategoryController::class);

        // Event Management
        Route::resource('events', AdminEventController::class);

        // Ticket Management 
        Route::resource('tickets', TicketController::class);

        // Histories
        Route::get('/histories', [HistoriesController::class, 'index'])->name('histories.index');
        Route::get('/histories/{id}', [HistoriesController::class, 'show'])->name('histories.show');
    });

});

require __DIR__ . '/auth.php';
