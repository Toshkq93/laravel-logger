<?php

use Illuminate\Support\Facades\Route;
use Toshkq93\Logger\Http\Controllers\LoggerController;

Route::get('/', [LoggerController::class, 'index'])->name('logs');
Route::delete('/delete', [LoggerController::class, 'delete'])->name('delete');
Route::get('/get-filters', [LoggerController::class, 'filters'])->name('filters');


