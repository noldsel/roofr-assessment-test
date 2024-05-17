<?php

namespace App\Http\Resources\Collection;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ParkingSpotResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }

    public function with($request)
    {
        return [
            'extra' => [
                'availableSpots' => $this->availableSpots(),
                'totalAvailableSpots' => $this->calculateTotalAvaialbleSpots(),
                'totalCapacity' => $this->getTotalCapacity()
            ],
        ];
    }

    protected function availableSpots()
    {
        // to build function. maybe not here in the resource collection file
        return [
            'regular' => $this->getAvailableRegularSpots(), // todo functions
            'motor' => $this->getAvailableMotorSpot(), // todo functions
            'van' => $this->getAvailableVanSpot(), // todo functions
        ];
    }

    protected function calculateTotalAvaialbleSpots()
    {
        // to build function. maybe not here in the resource collection file
    }

    protected function getTotalCapacity()
    {
        // to build function. maybe not here in the resource collection file
    }
}
