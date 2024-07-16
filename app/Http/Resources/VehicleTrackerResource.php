<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleTrackerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'manufacturer' => $this->manufacturer,
            'model' => $this->model,
            'year' => $this->year,
            'trackingStatus' => $this->tracking_status,
            // 'user' =>$this->user()->get()
        ];
    }
}
