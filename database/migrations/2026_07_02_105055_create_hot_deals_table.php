<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Create hot_deals table
        Schema::create('hot_deals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->unique();
            $table->decimal('discount_price', 10, 2);
            $table->dateTime('end_date')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        // 2. Migrate existing data from products to hot_deals
        $existingHotDeals = DB::table('products')
            ->where('is_hot_deal', true)
            ->get();

        foreach ($existingHotDeals as $product) {
            DB::table('hot_deals')->insert([
                'product_id' => $product->id,
                'discount_price' => $product->hot_deal_discount_price ?? 0.00,
                'end_date' => $product->hot_deal_end_date,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 3. Drop columns from products table
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['is_hot_deal', 'hot_deal_end_date', 'hot_deal_discount_price']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Add columns back to products table
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_hot_deal')->default(false)->after('is_new_arrival');
            $table->dateTime('hot_deal_end_date')->nullable()->after('is_hot_deal');
            $table->decimal('hot_deal_discount_price', 10, 2)->nullable()->after('hot_deal_end_date');
        });

        // 2. Copy data back from hot_deals to products
        $hotDeals = DB::table('hot_deals')->get();

        foreach ($hotDeals as $deal) {
            DB::table('products')
                ->where('id', $deal->product_id)
                ->update([
                    'is_hot_deal' => true,
                    'hot_deal_end_date' => $deal->end_date,
                    'hot_deal_discount_price' => $deal->discount_price,
                ]);
        }

        // 3. Drop hot_deals table
        Schema::dropIfExists('hot_deals');
    }
};
