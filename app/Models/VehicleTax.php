<?php

namespace App\Models;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehicleTax extends Model
{
    use HasFactory,Uuids;

    protected $fillable= [
        'id','vehicle_id','from','to'
    ];
    protected $casts =[
        'id'=>'string',
        'vehicle_id'=>'string',
    ];
    
    /**
     * Get the vehicle that owns the VehicleAssurance
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }
}
