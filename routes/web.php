<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShortUrlController;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Admin\ServiceController;

// 認証関連のルートを先に読み込む
require __DIR__.'/auth.php';

// /login へのアクセスを /user/login にリダイレクト
Route::redirect('/login', '/user/login');

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

// ワイルドカードルートを最後に配置
Route::get('/{key}/{user}', [ShortUrlController::class, 'redirect2'])->name('shorten.url2');
Route::get('/{key}',      [ShortUrlController::class, 'redirect'])->name('shorten.url');
