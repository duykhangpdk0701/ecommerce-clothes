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
        Schema::create('shipping_fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->tinyInteger('type')->default(1)->nullable();
            $table->decimal('value', 15, 4)->nullable();
            $table->tinyInteger('status')->default(0)->nullable();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('sys_countries');
            $table->foreign('city_id')->references('id')->on('sys_cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_fees');
    }
};
