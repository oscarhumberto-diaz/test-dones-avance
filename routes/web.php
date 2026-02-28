<?php

use App\Http\Controllers\ResultController;
use App\Livewire\SpiritualGiftsTest;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/test');
Route::get('/test', SpiritualGiftsTest::class)->name('test.index');
Route::get('/resultado/{attempt}', [ResultController::class, 'show'])->name('result.show');
