<?php

use App\Http\Controllers\IcsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', [IcsController::class, 'create'])
    ->middleware('throttle:ics')
    ->name('ics.create');
