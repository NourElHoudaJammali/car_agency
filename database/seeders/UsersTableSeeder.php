<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Prevent duplicate admin creation
        if (!User::where('email', 'admin@carrental.com')->exists()) {
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@carrental.com',
                'password' => Hash::make('password'), // Consider using env() for production
                'email_verified_at' => now(), // Mark as verified
                'remember_token' => Str::random(10),
                'role' => 'admin'
            ]);
        }

        // Create staff users
        User::create([
            'name' => 'Manager User',
            'email' => 'manager@carrental.com',
            'password' => Hash::make('manager123'),
            'role' => 'manager',
            'email_verified_at' => now()
        ]);

        // Create regular users with factory
        User::factory()
            ->count(5)
            ->create([
                'role' => 'user' // Ensure factory users have a role
            ]);
    }
}