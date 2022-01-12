<?php

namespace App\Models;
use App\Traits\Uuids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehicleType extends Model
{
    use HasFactory , Uuids;

    protected $fillable = ['id','name'];
    protected $casts = [
        'id'=>'string'
    ];
    /**
     * Get all of the categories for the VehicleType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories(): HasMany
    {
        return $this->hasMany(VehicleCategory::class, 'type_id', 'id');
    }

    /**
     * Get all of the vehicles for the VehicleType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'type_id', 'id');
    }
    
}
