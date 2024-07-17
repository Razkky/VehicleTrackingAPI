<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateVehicleStatusRequest;
use App\Http\Requests\UpdateVehicleTrackerRequest;
use App\Http\Resources\LocationCollection;
use App\Http\Resources\VehicleTrackerCollection;
use App\Http\Resources\VehicleTrackerResource;
use App\Models\VehicleTracker;
use App\Http\Response\ApiResponse;

class VehicleTrackerController extends Controller
{
    /**
     * Display a listing of the resource.
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

    public function updateVehicleStatus(UpdateVehicleStatusRequest $request, $id) {
        $validatedData = $request->validated();
        $vehicle = VehicleTracker::find($id);
        info($vehicle);
        if (!isset($vehicle)) {
            $error = 'No Vehicle with such id found';
            return ApiResponse::json(
                status: 'error',
                code: 404,
                error: $error,
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

    public function startTracking($id) {
        $vehicle = VehicleTracker::find($id);
        if (!isset($vehicle)) {
            $error = 'No Vehicle with such id found';
            return ApiResponse::json(
                status: 'error',
                code: 404,
                error: $error,
            );
        }
        $vehicle->tracking_status = true;
        $vehicle->save();
        $message = 'Tracking Started Successfully';
        return ApiResponse::json(
            status: 'success',
            code: 200,
            message: $message,
        );
    }

    public function stopTracking($id) {
        $vehicle = VehicleTracker::find($id);
        if (!isset($vehicle)) {
            $error = 'No Vehicle with such id found';
            return ApiResponse::json(
                status: 'error',
                code: 404,
                error: $error,
            );
        }
        $vehicle->tracking_status = false;
        $vehicle->save();
        $message = 'Tracking Stopped Successfully';
        return ApiResponse::json(
            status: 'success',
            code: 200,
            message: $message,
        );
    }

    public function getVehicleLocations($id) {
        $vehicle = VehicleTracker::find($id);
        if (!isset($vehicle)) {
            $error = 'No Vehicle with such id found';
            return ApiResponse::json(
                status: 'error',
                code: 404,
                error: $error,
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
