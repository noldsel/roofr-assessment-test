<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParkingSpotResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'is_availble' => $this->isAvailable,
            'start' => $this->start ?? null,
            'end' => $this->end ?? null,
            'type' => $this->type,
            'vehicle_type' => $this->vehicle_type ?? null
        ];
    }
}
