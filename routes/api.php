<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::resource('profile', ProfileController::class);
Route::resource('images', ImagesController::class)->only([
    'index',
    'store',
    'destroy'
]);

Route::get('profile/{id}/images', [\App\Http\Controllers\ProfileController::class, 'showimages']);
