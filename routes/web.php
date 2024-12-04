<?php

use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\LikeListController;
use App\Http\Controllers\TripController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinationController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('destinations', DestinationController::class)->names([
    'index' => 'destinations',
]);

Route::resource('accommodation', AccommodationController::class)->names([
    'index' => 'accommodation',
]);
Route::resource('activities', ActivityController::class)->names([
    'index' => 'activities',
]);

Route::middleware('auth')->group(function () {
    Route::post('/like/{type}/{id}', [LikeListController::class, 'like'])->name('like');
    Route::post('/unlike/{type}/{id}', [LikeListController::class, 'unlike'])->name('unlike');
    Route::get('/likelist', [LikeListController::class, 'index'])->name('likelist.index');
});

Route::middleware('auth')->group(function () {
    Route::resource('trips', TripController::class);
});

Auth::routes();
