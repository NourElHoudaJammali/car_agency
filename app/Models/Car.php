<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id', 'car_type_id', 'model', 'license_plate', 'daily_rate',
        'year', 'color', 'seats', 'description', 'available', 'image'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function carType()
    {
        return $this->belongsTo(CarType::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/default-car.png');
    }
}
