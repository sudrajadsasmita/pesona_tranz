<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $fillable = [
        'type', 'registration_number', 'class', 'status', 'price', 'driver_id', 'helper_id'
    ];
    protected $hidden = [];

    public function galleries()
    {
        return $this->hasMany(VehicleGallery::class, 'vehicle_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'transaction_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, "driver_id", 'id');
    }
    public function helper()
    {
        return $this->belongsTo(Helper::class, 'helper_id', 'id');
    }
}
