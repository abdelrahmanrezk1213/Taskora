<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Tasks
Route::middleware(['auth'])->group(function () {

    // Trash
    Route::get('/tasks/trash', [TaskController::class, 'trash'])
        ->name('tasks.trash');

    Route::patch('/tasks/{task}/restore', [TaskController::class, 'restore'])
        ->withTrashed()
        ->name('tasks.restore');

    Route::delete('/tasks/{task}/force-delete', [TaskController::class, 'forceDelete'])
        ->withTrashed()
        ->name('tasks.forceDelete');

    // Tasks
    Route::resource('tasks', TaskController::class);

    Route::get('/notifications/{notification}', [NotificationController::class, 'show'])
        ->name('notifications.show');

    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])
        ->name('notifications.markAllAsRead');
});

// Categories
Route::middleware('auth')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index');

    Route::middleware('admin')->group(function () {
        Route::get('/categories/create', [CategoryController::class, 'create'])
            ->name('categories.create');

        Route::post('/categories', [CategoryController::class, 'store'])
            ->name('categories.store');

        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
            ->name('categories.edit');

        Route::put('/categories/{category}', [CategoryController::class, 'update'])
            ->name('categories.update');

        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
            ->name('categories.destroy');
    });
});

require __DIR__ . '/auth.php';
