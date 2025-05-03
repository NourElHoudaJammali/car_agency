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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->foreignId('car_type_id')->constrained()->onDelete('cascade');
            $table->string('model');
            $table->string('license_plate')->unique();
            $table->decimal('daily_rate', 8, 2);
            $table->integer('year');
            $table->string('color');
            $table->integer('seats');
            $table->text('description')->nullable();
            $table->boolean('available')->default(true);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
