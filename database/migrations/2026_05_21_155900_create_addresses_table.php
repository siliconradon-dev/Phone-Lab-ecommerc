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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('public_user_id');
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('title'); // e.g., Home, Office
            $table->string('district');
            $table->string('city');
            $table->text('address');
            $table->string('landmark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
