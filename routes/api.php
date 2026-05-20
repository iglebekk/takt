<?php

use App\Http\Controllers\IcsController;
use Illuminate\Support\Facades\Route;

Route::post('/ics', [IcsController::class, 'store'])
    ->middleware('throttle:ics')
    ->name('api.ics.store');
