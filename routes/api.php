<?php

use App\Http\Controllers\ShortUrlController;

Route::get('/shorten/{key}', [ShortUrlController::class, 'redirect'])->name('shorten.url');