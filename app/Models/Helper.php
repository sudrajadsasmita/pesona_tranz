<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Helper extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'age', 'phone', 'address', 'photo'
    ];

    protected $hidden = [];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'driver_id');
    }
}
