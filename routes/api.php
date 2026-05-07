<?php

use App\Http\Controllers\Api\JokesController;

Route::get('/jokes', [JokesController::class, 'index']);
Route::post('/track', [App\Http\Controllers\Api\TrackingController::class, 'track']);
