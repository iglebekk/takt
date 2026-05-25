<?php

use App\Http\Controllers\IcsController;
use App\Http\Controllers\PublicPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicPageController::class, 'home'])
    ->name('home');

Route::get('/docs', [PublicPageController::class, 'docs'])
    ->name('docs');

Route::get('/about', [PublicPageController::class, 'about'])
    ->name('about');

Route::get('/create', [IcsController::class, 'create'])
    ->middleware('throttle:ics')
    ->name('ics.create');
