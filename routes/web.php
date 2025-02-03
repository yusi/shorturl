<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ServiceController;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\ShortUrlController;

Route::get('/', function (): View {
    return view('welcome');
});

Route::get('/dashboard', function (): View {
    return view('adminlte');
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
        Route::resource('event-users', \App\Http\Controllers\Admin\EventUserController::class);
        Route::get('get-events', [\App\Http\Controllers\Admin\EventUserController::class, 'getEvents'])
            ->name('get-events');
        Route::resource('settings', \App\Http\Controllers\Admin\SettingController::class);
    });
});

Route::get('/{key}/{user}', [ShortUrlController::class, 'redirect2'])->name('shorten.url2');
Route::get('/{key}',      [ShortUrlController::class, 'redirect'])->name('shorten.url');

require __DIR__.'/auth.php';
