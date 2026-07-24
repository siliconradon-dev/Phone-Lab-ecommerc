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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('public_user_id')->nullable();
            $table->string('guest_email')->nullable();
            $table->string('order_code')->unique();
            $table->string('full_name');
            $table->string('company')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('district');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->text('notes')->nullable();
            $table->enum('payment_method', ['card', 'cash', 'koko', 'mint', 'payzy'])->nullable();
            $table->decimal('total', 10, 2);
            $table->enum('order_status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->string('payment_status')->default('pending');
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
