<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->tinyInteger('rating'); // 1–5 stars
            $table->text('comment');

            $table->json('images')->nullable();

            //  Foreign key
            $table->foreignId('product_id')
                ->constrained('products')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};