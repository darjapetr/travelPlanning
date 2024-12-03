<?php

use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinationController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/activities', [App\Http\Controllers\ActivityController::class, 'index'])->name('activities');
Route::get('/accommodation', [App\Http\Controllers\AccommodationController::class, 'index'])->name('accommodation');

Route::get('/accommodation/{id}', [AccommodationController::class, 'show'])->name('accommodation.show');
Route::get('/activities/{id}', [ActivityController::class, 'show'])->name('activities.show');

Route::resource('destinations', DestinationController::class)->names([
    'index' => 'destinations',
]);

Auth::routes();
