<?php

use App\Models\Brand;
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
            $table->foreignIdFor(Brand::class);
            $table->string('name');
            $table->string('plate_number')->unique();
            $table->integer('vehicle_year');
            $table->string('color');
            $table->string('status');
            $table->decimal('base_price', 12);
            $table->boolean('with_driver')->default(false);
            $table->decimal('driver_price', 12)->nullable();
            $table->string('transmission_type');
            $table->integer('total_seat');
            $table->integer('total_baggage');
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
