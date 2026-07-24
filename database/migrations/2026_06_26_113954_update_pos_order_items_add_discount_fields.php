<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pos_order_items', function (Blueprint $table) {

            $table->string('discount_type')->nullable()->after('price');

            $table->decimal('discount_value', 10, 2)->default(0)->after('discount_type');

            $table->decimal('line_total', 10, 2)->default(0)->after('discount_value');
        });
    }

    public function down(): void
    {
        Schema::table('pos_order_items', function (Blueprint $table) {
            $table->dropColumn([
                'discount_type',
                'discount_value',
                'line_total'
            ]);
        });
    }
};