<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Redirect::route('dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Redirect::route('activity.select-activity');
    })->name('dashboard');

    Route::resource('client', \App\Http\Controllers\ClientController::class);
    Route::get('activity/steps/{unique_key}/{client_id}', [\App\Http\Controllers\ActivityController::class, 'steps']);
    Route::post('activity/date', [\App\Http\Controllers\ActivityController::class, 'dateTimeInfo'])->name('activity.date-time-info');
    Route::get('activity/select-activity', [\App\Http\Controllers\ActivityController::class, 'selectActivity'])->name('activity.select-activity');
    Route::get('activity/create', [\App\Http\Controllers\ActivityController::class, 'create'])->name('activity.create');
    Route::post('activity', [\App\Http\Controllers\ActivityController::class, 'store'])->name('activity.store');
});
