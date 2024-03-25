<?php

use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [VehicleController::class, 'listVehicles'])->name('vehicles.list');

Route::get('/vehicle/create', [VehicleController::class, 'create'])->name('vehicles.create');
Route::get('/vehicle/edit/{id}', [VehicleController::class, 'edit'])->name('vehicle.edit');
Route::post('/vehicle', [VehicleController::class, 'store'])->name('vehicle.store');
Route::put('/vehicle/{id}', [VehicleController::class, 'update'])->name('vehicle.update');
Route::delete('/vehicle/{id}', [VehicleController::class, 'destroy'])->name('vehicle.delete');

Auth::routes();

Route::get('/home', [VehicleController::class, 'index'])->name('home');
