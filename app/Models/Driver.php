<?php

namespace App\Models;
use App\Traits\Uuids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Driver extends Model
{
    use HasFactory ,Uuids;
    protected $fillable = [
        'id','names','is_occupied'
    ];

    protected $casts = [
        'id'=>'string'
    ];

    /**
     * Get the vehicle associated with the Driver
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vehicle(): HasOne
    {
        return $this->hasOne(Vehicle::class, 'driver_id', 'id');
    }
}
