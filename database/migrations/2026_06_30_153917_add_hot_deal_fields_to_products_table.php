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
            if (!Schema::hasColumn('products', 'hot_deal_end_date')) {
                $table->dateTime('hot_deal_end_date')->nullable()->after('is_hot_deal');
            }
            if (!Schema::hasColumn('products', 'hot_deal_discount_price')) {
                $table->decimal('hot_deal_discount_price', 10, 2)->nullable()->after('hot_deal_end_date');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $columns = [];
            if (Schema::hasColumn('products', 'hot_deal_end_date')) {
                $columns[] = 'hot_deal_end_date';
            }
            if (Schema::hasColumn('products', 'hot_deal_discount_price')) {
                $columns[] = 'hot_deal_discount_price';
            }
            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};
