<?php

namespace App\State\Processors;


use App\Models\ParkingSpot;

class ParkingSpotProcessor
{

    public function create(array $params)
    {
        // not used, because we created parking spots through seeder
    }

    public function update(ParkingSpot $parkingSpot, array $params, bool $isAvailable): ParkingSpot
    {
        $parkingSpot->is_available = $isAvailable;

        if (!$isAvailable) {
            $parkingSpot->start = $params['start']; // assumed validated in DateTime format
        } else {
            $parkingSpot->end = $params['end']; // assumed validated in DateTime format
        }

        $parkingSpot->parking_spot_type_id = $params['type_id']; // assumed validated
        $parkingSpot->vehicle_type = $params['vehicle_type'] ?? null;


        $parkingSpot->save();

        return $parkingSpot;

    }

}
