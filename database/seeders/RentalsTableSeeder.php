<?php

namespace Database\Seeders;

use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RentalsTableSeeder extends Seeder
{
    public function run()
    {
        // Active rental
        Rental::create([
            'car_id' => 1,
            'customer_id' => 1,
            'user_id' => 1,
            'start_date' => Carbon::today(),
            'end_date' => Carbon::today()->addDays(5),
            'total_amount' => 229.95, // 5 days * 45.99
            'status' => 'active',
            'notes' => 'Regular customer'
        ]);

        // Completed rental
        Rental::create([
            'car_id' => 2,
            'customer_id' => 2,
            'user_id' => 1,
            'start_date' => Carbon::today()->subDays(10),
            'end_date' => Carbon::today()->subDays(5),
            'total_amount' => 299.95, // 5 days * 59.99
            'status' => 'completed',
            'notes' => 'Extended rental'
        ]);

        // Add 5-8 more rental records with different statuses
    }
}