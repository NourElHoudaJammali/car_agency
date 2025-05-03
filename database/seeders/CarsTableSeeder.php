<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarsTableSeeder extends Seeder
{
    public function run()
    {
        // Clear existing records
        DB::table('cars')->truncate();

        $cars = [
            [
                'brand_id' => 1, // Toyota
                'car_type_id' => 1, // Sedan
                'model' => 'Camry',
                'license_plate' => 'ABC123',
                'daily_rate' => 45.99,
                'year' => 2022,
                'color' => 'Silver',
                'seats' => 5,
                'description' => 'Reliable mid-size sedan',
                'available' => true,
                'image' => 'cars/camry.jpg'
            ],
            [
                'brand_id' => 2, // Honda
                'car_type_id' => 2, // SUV
                'model' => 'CR-V',
                'license_plate' => 'XYZ789',
                'daily_rate' => 59.99,
                'year' => 2023,
                'color' => 'Black',
                'seats' => 5,
                'description' => 'Popular SUV model',
                'available' => true,
                'image' => 'cars/crv.jpg'
            ],
            // Add 8-10 more cars with different combinations
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}