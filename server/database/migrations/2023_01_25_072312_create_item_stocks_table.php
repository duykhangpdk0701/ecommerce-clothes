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
        Schema::create('item_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_variant_id')->constrained();
            $table->foreignId('item_id')->constrained();
            $table->foreignId('color_id')->constrained('item_colors')->nullable();
            $table->foreignId('size_id')->nullable()->references('id')->on('item_sizes');
            $table->foreignId('stock_status_id')->nullable()->references('id')->on('item_stock_statuses');

            $table->string('code');
            $table->string('sku');

            $table->string('size_value');
            $table->string('color_value')->nullable();
            $table->string('color_name');

            $table->decimal('price_in', 16, 4);
            $table->decimal('price', 16, 4);

            $table->integer('is_sale')->nullable();
            $table->decimal('old_price', 16, 4)->nullable();

            $table->date('stock_in_date')->nullable();
            $table->string('stock_in_note')->nullable();
            $table->integer('stock_in_type')->nullable();

            $table->date('stock_out_date')->nullable();
            $table->string('stock_out_note')->nullable();
            $table->integer('stock_out_type')->nullable();


            $table->integer('status')->default(0);

            $table->foreignId('created_by')->references('id')->on('users');

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
        Schema::dropIfExists('item_stocks');
    }
};
