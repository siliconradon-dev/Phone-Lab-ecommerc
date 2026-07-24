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
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_discount')->default(false)->after('base_price');
            $table->decimal('discount_price', 10, 2)->nullable()->after('is_discount');
            $table->boolean('is_new_arrival')->default(false)->after('discount_price');
            $table->boolean('is_hot_deal')->default(false)->after('is_new_arrival');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['is_discount', 'discount_price', 'is_new_arrival', 'is_hot_deal']);
        });
    }
};
