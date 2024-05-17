<?php

namespace App\Services;


use App\Models\ParkingSpot;
use App\State\Providers\ParkingSpotProvider;
use App\State\Processors\ParkingSpotProcessor;
use App\Http\Resources\Collection\ParkingSpotResourceCollection as ResourceCollection;
use App\Http\Resources\ParkingSpotResource as Resource;
use App\Exceptions\ParkingSpotNotAvailableException;


class ParkingSpotService
{
    public function __construct(
        protected readonly ParkingSpotProvider $provider,
        protected ParkingSpotProcessor $processor)
    {
    }

    public function listWithSearch(array $params)
    {
        $spots = $this->provider->listWithSearch($params);

        return new ResourceCollection($spots);
    }

    public function park(ParkingSpot $parkingSpot, array $params)
    {
        if (!$this->checkIfAvailable($parkingSpot, $params)) {
            throw new ParkingSpotNotAvailableException();
        }

        $spot = $this->processor->update($parkingSpot, $params, false);

        return new Resource($spot);

    }

    public function unpark(ParkingSpot $parkingSpot, array $params)
    {
        $spot = $this->processor->update($parkingSpot, $params, true);

        return new Resource($spot);
    }

    protected function checkIfAvailable(ParkingSpot $parkingSpot, array $params): bool
    {
        if (!$parkingSpot->is_available) {
            return false;
        }

        // Motorcycles can park in any available spot
        if ($params['vehicle_type'] === 'motor') {
            return true;
        }

        // Cars can take any regular spot within the parking lot.
        if ($params['vehicle_type'] === 'car' && $parkingSpot->type == 'regular') {
            return true;
        }


        // Vans are also permitted to park, but they need a space equivalent to three regular spots.
        if ($params['vehicle_type'] === 'van' && $parkingSpot->type !== 'van') {
            // The parking layout is assumed to be one row of parking spots. So 'next spot'
            //      means either on the left or on the right of the 'current spot'
            $spotOnTheRight = ParkingSpot::find($parkingSpot->id + 1);
            $spotOnTheLeft = ParkingSpot::find($parkingSpot->id - 1);

            if (!empty($spotOnTheRight) && !empty($spotOnTheLeft)
                && $spotOnTheRight->is_available && $spotOnTheLeft->is_available) {
                return true;
            }

        }

        return false;

    }

}
