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
        Schema::create('pos_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->nullable();
            $table->bigInteger('cashier_id');
            $table->string('order_code')->unique();
            $table->enum('payment_method', ['cash', 'card', 'koko']);
            $table->decimal('total_amount', 10, 2);
            $table->decimal('paid_amount', 10, 2);
            $table->decimal('balance_amount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_orders');
    }
};
