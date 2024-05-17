<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingSpot extends Model
{
    use HasFactory;

    protected $table = 'parking_spot';

    protected $fillable = [
        'is_available',
        'parking_spot_type_id',
        'vehicle_type',
        'start'
    ];

    public function type()
    {
        return $this->belongsTo(ParkingSpotType::class);
    }
}
