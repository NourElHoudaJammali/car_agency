<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add the role column after password with default as 'user'
            $table->string('role')
                  ->default('user')
                  ->after('password')
                  ->comment('User role: admin, staff, user etc.');
        });
        
        // Optional: Update existing users if needed
        // DB::table('users')->whereNull('role')->update(['role' => 'user']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove the role column if rolling back
            $table->dropColumn('role');
        });
    }
};