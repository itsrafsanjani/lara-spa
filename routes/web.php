<?php

use Illuminate\Support\Facades\Route;

Route::get('{path}', function () {
    return view('app');
})->where('path', '([A-z\/_.\d-]+)?');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
