<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    public function run()
    {
        $brands = [
            ['name' => 'Toyota', 'logo' => 'brands/toyota.png'],
            ['name' => 'Honda', 'logo' => 'brands/honda.png'],
            ['name' => 'Ford', 'logo' => 'brands/ford.png'],
            ['name' => 'BMW', 'logo' => 'brands/bmw.png'],
            ['name' => 'Mercedes', 'logo' => 'brands/mercedes.png'],
            ['name' => 'Tesla', 'logo' => 'brands/tesla.png'],
            ['name' => 'Nissan', 'logo' => 'brands/nissan.png'],
            ['name' => 'Chevrolet', 'logo' => 'brands/chevrolet.png'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}