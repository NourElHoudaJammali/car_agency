<?php

namespace Database\Seeders;

use App\Models\CarType;
use Illuminate\Database\Seeder;

class CarTypesTableSeeder extends Seeder
{
    public function run()
    {
        $carTypes = [
            ['name' => 'Sedan', 'description' => 'Standard passenger car'],
            ['name' => 'SUV', 'description' => 'Sport utility vehicle'],
            ['name' => 'Truck', 'description' => 'Pickup truck'],
            ['name' => 'Van', 'description' => 'Passenger or cargo van'],
            ['name' => 'Convertible', 'description' => 'Car with retractable roof'],
            ['name' => 'Coupe', 'description' => 'Two-door car'],
            ['name' => 'Hatchback', 'description' => 'Car with rear door'],
            ['name' => 'Minivan', 'description' => 'Family-oriented vehicle'],
            ['name' => 'Sports Car', 'description' => 'High-performance car'],
            ['name' => 'Luxury', 'description' => 'Premium vehicle'],
        ];

        foreach ($carTypes as $carType) {
            CarType::create($carType);
        }
    }
}