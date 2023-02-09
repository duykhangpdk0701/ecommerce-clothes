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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code', 26)->unique();
            $table->unsignedBigInteger('staff_id');
            $table->foreign('staff_id')->references('id')->on('users');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('users');
            $table->string('billing_name', 255)->nullable();
            $table->string('billing_address', 255)->nullable();
            $table->integer('billing_country_id')->nullable();
            $table->integer('billing_city_id')->nullable();
            $table->integer('billing_district_id')->nullable();
            $table->integer('billing_ward_id')->nullable();
            $table->string('billing_phone', 32)->nullable();
            $table->string('billing_taxcode', 32)->nullable();

            $table->string('shipping_name', 255)->nullable();
            $table->string('shipping_address', 255)->nullable();
            $table->integer('shipping_country_id')->nullable();
            $table->integer('shipping_city_id')->nullable();
            $table->integer('shipping_district_id')->nullable();
            $table->integer('shipping_ward_id')->nullable();
            $table->string('shipping_phone', 32)->nullable();
            $table->string('shipping_taxcode', 32)->nullable();
            $table->foreignId('shipper_id')->nullable()->constrained('users');
            $table->uuid('uuid');
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
        Schema::dropIfExists('orders');
    }
};
