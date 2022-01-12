<?php

namespace App\Models;
use App\Traits\Uuids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    use HasFactory ,Uuids;
    protected $fillable = [
        'id','type_id','category_id','brand','model','plate_no','acquisition_date','department_id','driver_id','is_assured'
    ];
    protected $casts = [
        'id'=>'string',
        'type_id'=>'string',
        'category_id'=>'string',
        'department_id'=>'string',
        'driver_id'=>'string'
    ];

    /**
     * Get the type that owns the Vehicle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class, 'type_id', 'id');
    }
    /**
     * Get the category that owns the Vehicle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(VehicleCategory::class, 'category_id', 'id');
    }

    /**
     * Get the driver that owns the Vehicle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }

    /**
     * Get the department that owns the Vehicle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    /**
     * Get the assurance for the Vehicle
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assurance(): HasMany
    {
        return $this->hasOne(VehicleAssurance::class, 'vehicle_id', 'id');
    }

    /**
     * Get all of the taxes for the Vehicle
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function taxes(): HasMany
    {
        return $this->hasMany(VehicleTax::class, 'vehicle_id', 'id');
    }

    /**
     * Get all of the attachments for the Vehicle
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class, 'vehicle_id', 'id');
    }
}
