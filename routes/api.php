<?php

use App\Http\Controllers\VehicleTrackerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function($router) {
    Route::get('vehicles', [VehicleTrackerController::class, 'getVehicles']);
    Route::put('vehicle/{id}/update_status', [VehicleTrackerController::class, 'updateVehicleStatus']);
    Route::post('vehicle/{id}/start_tracking', [VehicleTrackerController::class, 'startTracking']);
    Route::post('vehicle/{id}/stop_tracking', [VehicleTrackerController::class, 'stopTracking']);
    Route::get('vehicle/{id}/locations', [VehicleTrackerController::class, 'getVehicleLocations']);
});
