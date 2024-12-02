<?php

use App\Http\Controllers\AccommodationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinationController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/destinations', [App\Http\Controllers\DestinationController::class, 'index'])->name('destinations');
Route::get('/activities', [App\Http\Controllers\ActivityController::class, 'index'])->name('activities');
Route::get('/accommodation', [App\Http\Controllers\AccommodationController::class, 'index'])->name('accommodation');

Route::get('/destinations/{id}', [DestinationController::class, 'show'])->name('destinations.show');
Route::get('/accommodation/{id}', [AccommodationController::class, 'show'])->name('accommodation.show');

Auth::routes();
