<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pos_orders', function (Blueprint $table) {

            $table->decimal('subtotal', 10, 2)->after('balance_amount')->default(0);

            $table->string('bill_discount_type')->nullable()->after('subtotal');

            $table->decimal('bill_discount_value', 10, 2)->default(0)->after('bill_discount_type');

            $table->decimal('bill_discount_amount', 10, 2)->default(0)->after('bill_discount_value');
        });
    }

    public function down(): void
    {
        Schema::table('pos_orders', function (Blueprint $table) {
            $table->dropColumn([
                'subtotal',
                'bill_discount_type',
                'bill_discount_value',
                'bill_discount_amount'
            ]);
        });
    }
};