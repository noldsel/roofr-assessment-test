<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParkingSpot;
use App\Services\ParkingSpotService;

class ParkingSpotController extends Controller
{
    public function __construct(protected ParkingSpotService $service)
    {

    }

    public function list(Request $request)
    {
        // assume authorized
        // todo: create validator and validate $request before calling on the service

        return $this->service->listWithSearch($request->all());

    }

    public function park(Request $request, ParkingSpot $parkingSpot)
    {
        // assumed authorized
        // todo: create validator and validate $request before calling on the service

        return $this->service->park($parkingSpot, $request->all());

    }

    public function unpark(Request $request, ParkingSpot $parkingSpot)
    {
        // assume authorized
        // todo: create validator and validate $request before calling on the service

        return $this->service->unpark($parkingSpot, $request->all());
    }
}
