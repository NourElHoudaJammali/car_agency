<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key constraints temporarily
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear existing data (optional - only for development)
        $this->truncateTables();

        // Seed essential reference data first
        $this->call([
            // Core reference data
            CarTypesTableSeeder::class,
            BrandsTableSeeder::class,

            // Infrastructure
            UsersTableSeeder::class,  // Includes admin user
            PermissionsSeeder::class, // If using permissions

            // Business entities
            CarsTableSeeder::class,
            CustomersTableSeeder::class,

            // Transactions
            RentalsTableSeeder::class,
        ]);

        // Re-enable constraints
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    protected function truncateTables(): void
    {
        if (!app()->isProduction()) {
            $tables = [
                'rentals',
                'cars',
                'customers',
                'brands',
                'car_types',
                'users',
                'model_has_permissions', // If using permissions
                'permissions',
            ];

            foreach ($tables as $table) {
                DB::table($table)->truncate();
            }
            
            // Reset auto-increment counters
            DB::statement('ALTER TABLE users AUTO_INCREMENT = 1;');
            // Repeat for other tables as needed
        }
    }
}