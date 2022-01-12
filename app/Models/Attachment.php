<?php

namespace App\Models;
use App\Models\Uuids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attachment extends Model
{
    use HasFactory,Uuids;
    protected $fillable = [
        'id','vehicle_id','attachment_type','attachment'
    ];
    protected $casts = [
        'id'=>'string'
    ];

    /**
     * Get the vehicle that owns the Attachment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }
}
