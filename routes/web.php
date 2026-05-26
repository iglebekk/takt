<?php

use App\Http\Controllers\IcsController;
use App\Http\Controllers\PublicPageController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')
    ->name('home');

Route::get('/docs', [PublicPageController::class, 'docs'])
    ->name('docs');

Route::view('/privacy', 'privacy')
    ->name('privacy');

Route::get('/create', [IcsController::class, 'create'])
    ->middleware('throttle:ics')
    ->name('ics.create');
