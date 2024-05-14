<?php

use App\Enums\OrderStatus;
use App\Models\Car;
use App\Models\Customer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customer::class);
            $table->foreignIdFor(Car::class);
            $table->string('status')->default(OrderStatus::Unpaid);
            $table->string('payment_method')->nullable();
            $table->boolean('with_driver')->default(false);
            $table->decimal('total_price', 20)->nullable();
            $table->decimal('total_fine', 20)->nullable();
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->timestamp('returned_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
