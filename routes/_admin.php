Route::middleware('guest:admin')->group(function () {
    Route::get('admin/login', [LoginController::class, 'showLoginForm'])
        ->name('admin.login');
    Route::post('admin/login', [LoginController::class, 'login']);
});

Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])
        ->name('admin.logout');
    // ... 他の管理者用ルート
});