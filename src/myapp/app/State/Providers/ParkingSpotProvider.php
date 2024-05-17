<?php

namespace App\State\Providers;

use Illuminate\Support\Arr;
use App\Models\ParkingSpot;

class ParkingSpotProvider
{
    public function listWithSearch(array $params)
    {
        $model = new ParkingSpot();

        $tableName = $model->getTable();

        $params['search'] = '';

        if (Arr::has($params, 'search')) {
            $model = $model->search($params['search']);
        }

        return $model->with('type')->orderBy($tableName.'.id', 'desc');
    }
}
