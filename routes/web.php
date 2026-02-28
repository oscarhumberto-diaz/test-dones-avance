<?php

use App\Http\Controllers\ResultController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/test');
Route::view('/test', 'test.index')->name('test.index');
Route::get('/resultado/{attempt}', [ResultController::class, 'show'])->name('result.show');
