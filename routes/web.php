<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/stats', [App\Http\Controllers\Admin\StatsController::class, 'index'])->name('stats');
