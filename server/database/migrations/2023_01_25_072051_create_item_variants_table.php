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
        Schema::create('item_variants', function (Blueprint $table) {
            $table->id();
            $table->string('sku');

            $table->foreignId('item_id')->constrained();

            $table->foreignId('color_id')->constrained('item_colors')->nullable();

            $table->foreignId('size_id')
                ->references('id')
                ->on('item_sizes');

            $table->integer('order')->nullable()->default(0);
            $table->integer('status')->nullable()->default(1);

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
        Schema::dropIfExists('item_variants');
    }
};
