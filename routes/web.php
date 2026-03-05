<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\ProfilePasswordController;
use App\Http\Controllers\ResultController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/test');
Route::view('/test', 'test.index')->name('test.index');
Route::get('/resultado/{attempt}', [ResultController::class, 'show'])->name('result.show');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [LoginController::class, 'create'])->name('login');
        Route::post('/login', [LoginController::class, 'store'])->name('login.store');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');

        Route::prefix('consultas')->name('history.')->group(function () {
            Route::get('/historial', [HistoryController::class, 'index'])->name('index');
            Route::get('/historial/{attempt}', [HistoryController::class, 'show'])->name('show');
        });

        Route::prefix('perfil')->name('profile.')->group(function () {
            Route::get('/password', [ProfilePasswordController::class, 'edit'])->name('password.edit');
            Route::put('/password', [ProfilePasswordController::class, 'update'])->name('password.update');
        });

        Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    });
});
