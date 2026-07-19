<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomepageFeatureController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::view('/order', 'order')->name('order');

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'create'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('admin.login.store');
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/good-stuff', [HomepageFeatureController::class, 'index'])->name('good-stuff.index');
    Route::put('/good-stuff/{feature}', [HomepageFeatureController::class, 'update'])->name('good-stuff.update');
    Route::delete('/good-stuff/{feature}/image', [HomepageFeatureController::class, 'reset'])->name('good-stuff.reset');
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
});
