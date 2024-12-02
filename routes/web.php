<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/destinations', [App\Http\Controllers\DestinationController::class, 'index'])->name('destinations');
Route::get('/activities', [App\Http\Controllers\ActivityController::class, 'index'])->name('activities');
Route::get('/accommodation', [App\Http\Controllers\AccommodationController::class, 'index'])->name('accommodation');

Auth::routes();
