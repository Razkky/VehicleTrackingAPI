<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateVehicleTrackerRequest;
use App\Http\Resources\VehicleTrackerCollection;
use App\Http\Resources\VehicleTrackerResource;
use App\Models\VehicleTracker;

class VehicleTrackerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getVehicles()
    {
        return new VehicleTrackerCollection(VehicleTracker::all());
    }

    public function updateVehicleStatus(UpdateVehicleTrackerRequest $request, $id) {
        $vehicle = VehicleTracker::find($id);
        info($vehicle);
        if (!isset($vehicle)) {
            return response()->json(['error' => 'No Vehicle with such id found'], 200);
        }
        $vehicle->tracking_status = $request->trackingStatus;
        $vehicle->save();
        return new VehicleTrackerResource($vehicle);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleTrackerRequest $request, VehicleTracker $vehicleTracker)
    {
        //
    }

}
