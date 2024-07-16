<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateVehicleTrackerRequest;
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

    public function updateVehicleStatus(UpdateVehicleTrackerRequest $request, $id) {
        $vehicle = VehicleTracker::find($id);
        info($vehicle);
        if (!isset($vehicle)) {
            $message = 'No Vehicle with such id found';
            return ApiResponse::json(
                status: 'success',
                code: 400,
                message: $message,
            );
        }
        $vehicle->tracking_status = $request->trackingStatus;
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
            $message = 'No Vehicle with such id found';
            return ApiResponse::json(
                status: 'success',
                code: 400,
                message: $message,
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
            $message = 'No Vehicle with such id found';
            return ApiResponse::json(
                status: 'success',
                code: 400,
                message: $message,
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
            $message = 'No Vehicle with such id found';
            return ApiResponse::json(
                status: 'success',
                code: 400,
                message: $message,
            );
        }
        $locations = $vehicle->locations()->get();
        return ApiResponse::json(
            status: 'success',
            code: 200,
            data: $locations,
        );
    }

}
