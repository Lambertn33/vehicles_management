<?php

namespace App\Models;
use App\Traits\Uuids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehicleCategory extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'id','type_id','name'
    ];

    protected $casts = [
        'id'=>'string',
        'type_id'=>'string'
    ];

    /**
     * Get the type that owns the VehicleCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class, 'type_id', 'id');
    }
    /**
     * Get all of the vehicles for the VehicleType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'category_id', 'id');
    }

}
