<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShortUrlController;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\Auth\LoginController;

// 認証関連のルートを先に読み込む
require __DIR__.'/auth.php';

// /login へのアクセスを /user/login にリダイレクト
Route::redirect('/login', '/user/login');

// 管理者認証関連のルートを最初に定義（prefixを削除）
Route::middleware('guest:admin')->group(function () {
    Route::get('admin/login', [LoginController::class, 'showLoginForm'])
        ->name('admin.login');
    Route::post('admin/login', [LoginController::class, 'login']);
});

Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', function (): View {
        return view('adminlte');
    })->name('admin.dashboard');

    Route::post('logout', [LoginController::class, 'logout'])
        ->name('admin.logout');
    Route::resource('services', ServiceController::class);
    Route::resource('events', \App\Http\Controllers\Admin\EventController::class);
    Route::resource('event-users', \App\Http\Controllers\Admin\EventUserController::class);
    Route::get('get-events', [\App\Http\Controllers\Admin\EventUserController::class, 'getEvents'])
        ->name('get-events');
    Route::resource('settings', \App\Http\Controllers\Admin\SettingController::class);
});

// 一般ユーザー認証関連のルート
require __DIR__.'/auth.php';

// その他の一般ルート
Route::get('/', function (): View {
    return view('welcome');
});

Route::get('/dashboard', function (): View {
    return view('adminlte');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ワイルドカードルートを最後に配置
Route::get('/{key}/{user}', [ShortUrlController::class, 'redirect2'])->name('shorten.url2');
Route::get('/{key}',      [ShortUrlController::class, 'redirect'])->name('shorten.url');
