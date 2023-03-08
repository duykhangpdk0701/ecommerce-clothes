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
            $table->unsignedBigInteger('payment_method_id');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
            $table->string('payment_method', 128)->nullable();
            $table->double('payment_fee', '15', '4')->default('0.0000');
            $table->tinyInteger('payment_fee_type')->default('0');

            $table->text('comment')->nullable();
            $table->double('total_price', '15', '4')->default('0.0000');
            $table->double('total_discount', '15', '4')->default('0.0000');
            $table->double('total_tax', '15', '4')->default('0.0000');
            $table->double('total_shipping', '15', '4')->default('0.0000');
            $table->double('total_payment_fee', '15', '4')->default('0.0000');
            $table->double('total', '15', '4')->default('0.0000');
            $table->double('original_total', '16', '4')->default('0.0000');

            $table->unsignedBigInteger('order_status_id');
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->string('tracking', 64)->nullable();
            $table->ipAddress('ip')->nullable();
            $table->ipAddress('forwarded_ip')->nullable();
            $table->string('user_agent', 255)->nullable();
            $table->string('accept_language', 255)->nullable();

            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');

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
