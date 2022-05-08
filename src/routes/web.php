<?php

use Illuminate\Support\Facades\Route;
use Toshkq93\Logger\Http\Controllers\LoggerController;

Route::group(['middleware' => 'loginLogger'], function (){
    Route::get('/logs', [LoggerController::class, 'index'])->name('logs');
    Route::delete('/logs/delete', [LoggerController::class, 'delete'])->name('delete');
    Route::get('/get-filters', [LoggerController::class, 'filters'])->name('filters');
});

