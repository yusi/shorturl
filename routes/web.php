<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ServiceController;
use Illuminate\Contracts\View\View;

Route::get('/', function (): View {
    return view('welcome');
});

Route::get('/dashboard', function (): View {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function (): void {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('admin', function (): View {
        return view('adminlte');
    });
    Route::prefix('admin')->middleware(['auth'])->group(function (): void {
        Route::resource('services', ServiceController::class);
        Route::resource('events', \App\Http\Controllers\Admin\EventController::class);
    });
});

require __DIR__.'/auth.php';
