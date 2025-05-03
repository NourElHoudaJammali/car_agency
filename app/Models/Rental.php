<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id', 'customer_id', 'user_id', 'start_date',
        'end_date', 'total_amount', 'status', 'notes'
    ];

    protected $dates = ['start_date', 'end_date'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}