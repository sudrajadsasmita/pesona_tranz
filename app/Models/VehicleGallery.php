<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleGallery extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'photo', 'is_default', 'vehicle_id'
    ];

    protected $hidden = [];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }
    public function getPhotoAttribute($value)
    {
        return url('/storage/' . $value);
    }
}
