<?php

use App\Http\Controllers\IcsController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')
    ->name('home');

Route::view('/docs', 'docs.index')
    ->name('docs');

Route::view('/privacy', 'privacy')
    ->name('privacy');

Route::get('/create', [IcsController::class, 'create'])
    ->middleware('throttle:ics')
    ->name('ics.create');
