<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\HistoriesController;
use App\Http\Controllers\EventController;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $query = Event::with(['kategori', 'tickets']);

    // Filter by category if provided
    if (request('kategori')) {
        $query->where('category_id', request('kategori'));
    }

    $events = $query->get();

    return view('home', [
        'categories' => Category::all(),
        'events' => $events
    ]);
})->name('home');

// Public Event Detail
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

Route::middleware('auth')->group(function () {

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

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
