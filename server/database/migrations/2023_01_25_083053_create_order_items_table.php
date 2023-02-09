<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedBigInteger('order_status_id');
            $table->foreign('order_status_id')->references('id')->on('order_statuses');
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items');
            $table->unsignedBigInteger('item_variant_id');
            $table->foreign('item_variant_id')->references('id')->on('item_variants');
            $table->unsignedBigInteger('item_stock_id');
            $table->foreign('item_stock_id')->references('id')->on('item_stocks');
            $table->unsignedBigInteger('size_id');
            $table->foreign('size_id')->references('id')->on('item_sizes');
            $table->unsignedBigInteger('coupon_code_id')->nullable();
            $table->foreign('coupon_code_id')->references('id')->on('coupon_codes');
            $table->string('item_name', 255);
            $table->string('sku', 64);
            $table->string('code', 64);
            $table->string('size_value', 30);
            $table->double('price_in', '15', '4')->default('0.0000');
            $table->double('price', '15', '4')->default('0.0000');
            $table->integer('quantity')->nullable();
            $table->double('discount', '15', '4')->default('0.0000');
            $table->double('tax', '15', '4')->default('0.0000');
            $table->double('shipping', '15', '4')->default('0.0000');
            $table->double('payment_fee', '15', '4')->default('0.0000');
            $table->double('total', '15', '4')->default('0.0000');
            $table->integer('reward')->nullable();
            $table->foreignId('color_id')->nullable()->constrained('item_colors');
            $table->string('color_value', 30)->nullable();
            $table->string('color_name', 30)->nullable();
            $table->foreignId('order_detail_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
