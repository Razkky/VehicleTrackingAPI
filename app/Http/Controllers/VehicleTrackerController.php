<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateVehicleStatusRequest;
use App\Http\Resources\LocationCollection;
use App\Http\Resources\VehicleTrackerCollection;
use App\Http\Resources\VehicleTrackerResource;
use App\Models\VehicleTracker;
use App\Http\Response\ApiResponse;

class VehicleTrackerController extends Controller
{
    /**
     * Retrieve a listing of all vehicles in the system.
     *
     * @return ApiResponse Returns an API response with all vehicles.
     */
    public function getVehicles()
    {
        $data = new VehicleTrackerCollection(VehicleTracker::all());
        return ApiResponse::json(
            status: 'success',
            code: 200,
            data: $data
        );
    }

    /**
     * Update the tracking status of a specified vehicle.
     *
     * @param UpdateVehicleStatusRequest $request Validated request data.
     * @param int $id The ID of the vehicle to update.
     * @return ApiResponse Returns an API response with the updated vehicle or error message.
     */
    public function updateVehicleStatus(UpdateVehicleStatusRequest $request, $id) {
        $validatedData = $request->validated();
        $vehicle = VehicleTracker::find($id);
        if (!isset($vehicle)) {
            return ApiResponse::json(
                status: 'error',
                code: 404,
                error: 'No Vehicle with such id found',
            );
        }
        $vehicle->tracking_status = $validatedData['trackingStatus'];
        $vehicle->save();
        $data = new VehicleTrackerResource($vehicle);
        return ApiResponse::json(
            status: 'success',
            code: 200,
            data: $data
        );
    }

    /**
     * Start tracking a specified vehicle.
     *
     * @param int $id The ID of the vehicle to start tracking.
     * @return ApiResponse Returns an API response indicating tracking has started or error message.
     */
    public function startTracking($id) {
        $vehicle = VehicleTracker::find($id);
        if (!isset($vehicle)) {
            return ApiResponse::json(
                status: 'error',
                code: 404,
                error: 'No Vehicle with such id found',
            );
        }
        $vehicle->tracking_status = true;
        $vehicle->save();
        return ApiResponse::json(
            status: 'success',
            code: 200,
            message: 'Tracking Started Successfully',
        );
    }

    /**
     * Stop tracking a specified vehicle.
     *
     * @param int $id The ID of the vehicle to stop tracking.
     * @return ApiResponse Returns an API response indicating tracking has stopped or error message.
     */
    public function stopTracking($id) {
        $vehicle = VehicleTracker::find($id);
        if (!isset($vehicle)) {
            return ApiResponse::json(
                status: 'error',
                code: 404,
                error: 'No Vehicle with such id found',
            );
        }
        $vehicle->tracking_status = false;
        $vehicle->save();
        return ApiResponse::json(
            status: 'success',
            code: 200,
            message: 'Tracking Stopped Successfully',
        );
    }

    /**
     * Retrieve location data for a specified vehicle.
     *
     * @param int $id The ID of the vehicle whose locations are to be retrieved.
     * @return ApiResponse Returns an API response with location data or an error message.
     */
    public function getVehicleLocations($id) {
        $vehicle = VehicleTracker::find($id);
        if (!isset($vehicle)) {
            return ApiResponse::json(
                status: 'error',
                code: 404,
                error: 'No Vehicle with such id found',
            );
        }
        $locations = new LocationCollection($vehicle->locations()->get());
        return ApiResponse::json(
            status: 'success',
            code: 200,
            data: $locations,
        );
    }
}
