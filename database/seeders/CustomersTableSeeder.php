<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CustomersTableSeeder extends Seeder
{
    public function run()
    {
        // Create demo customers first
        $this->createDemoCustomers();

        // Then generate random customers
        Customer::factory()
            ->count(20)
            ->create();
    }

    protected function createDemoCustomers(): void
    {
        // Array of demo customers for easier management
        $demoCustomers = [
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'phone' => '+1234567890',
                'address' => '123 Main St',
                'city' => 'New York',
                'state' => 'NY',
                'zip_code' => '10001',
                'country' => 'USA',
                'notes' => 'VIP customer'
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane@example.com',
                'phone' => '+1987654321',
                'address' => '456 Oak Ave',
                'city' => 'Los Angeles',
                'state' => 'CA',
                'zip_code' => '90001',
                'country' => 'USA',
                'notes' => 'Frequent renter'
            ]
        ];

        foreach ($demoCustomers as $customer) {
            if (!Customer::where('email', $customer['email'])->exists()) {
                Customer::create($customer);
            }
        }
    }
}