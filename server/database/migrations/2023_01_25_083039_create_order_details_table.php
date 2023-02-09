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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items');
            $table->unsignedBigInteger('size_id');
            $table->foreign('size_id')->references('id')->on('item_sizes');
            $table->string('size_value', 30)->nullable();
            $table->double('price', '15', '4')->default('0.0000');
            $table->integer('quantity')->nullable();
            $table->text('items')->nullable();
            $table->string('coupon_code', 45)->nullable()->change();
            $table->foreignId('color_id')->nullable();
            $table->string('color_value', 30)->nullable();
            $table->string('color_name', 30)->nullable();
            $table->foreignId('item_variant_id')->nullable()->constrained();
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
        Schema::dropIfExists('order_details');
    }
};
