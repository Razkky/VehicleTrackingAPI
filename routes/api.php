<?php

use App\Http\Controllers\VehicleTrackerController;
use App\Models\VehicleTracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    // Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    // Route::post('me', 'AuthController@me');
});

Route::group(['prefix' => 'v1'], function($router) {
    Route::get('vehicles', [VehicleTrackerController::class, 'getVehicles']);
    Route::post('vehicle/{id}/update_status', [VehicleTrackerController::class, 'updateVehicleStatus']);
});
