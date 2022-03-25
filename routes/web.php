<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleGalleryController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('vehicle/{id}/gallery', [VehicleController::class, 'gallery'])->name('vehicle.gallery');
    Route::resource('vehicle', VehicleController::class);
    Route::post('driver/{id}/update', [DriverController::class, 'submitUpdate']);
    Route::resource('driver', DriverController::class);
    Route::post('helper/{id}/update', [HelperController::class, 'submitUpdate']);
    Route::resource('helper', HelperController::class);
    Route::resource('gallery', VehicleGalleryController::class);
    Route::resource('transaction', TransactionController::class);
});

require __DIR__ . '/auth.php';
