<?php

namespace App\Models;
use App\Traits\uuids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory , Uuids;
    protected $fillable = [
        'id','name'
    ];

    protected $casts = [
        'id'=>'string'
    ];

    /**
     * Get all of the vehicles for the Department
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'department_id', 'id');
    }
}
