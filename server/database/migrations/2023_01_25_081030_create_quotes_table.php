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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('quote_code')->unique('invoice_code_unique')->nullable();
            $table->string('email')->nullable();
            $table->foreignId('staff_id')->nullable()->constrained('users');
            $table->foreignId('customer_id')->nullable()->constrained('users');
            $table->string('billing_name')->nullable();
            $table->string('billing_address')->nullable();
            $table->foreignId('billing_country_id')->nullable()->constrained('sys_countries');
            $table->foreignId('billing_city_id')->nullable()->constrained('sys_cities');
            $table->foreignId('billing_district_id')->nullable()->constrained('sys_districts');
            $table->foreignId('billing_ward_id')->nullable()->constrained('sys_wards');
            $table->string('billing_phone')->nullable();
            $table->string('billing_tax_code')->nullable();
            $table->string('shipping_name')->nullable();
            $table->string('shipping_address')->nullable();
            $table->foreignId('shipping_country_id')->nullable()->constrained('sys_countries');
            $table->foreignId('shipping_city_id')->nullable()->constrained('sys_cities');
            $table->foreignId('shipping_district_id')->nullable()->constrained('sys_districts');
            $table->foreignId('shipping_ward_id')->nullable()->constrained('sys_wards');
            $table->string('shipping_phone')->nullable();
            $table->string('payment_method')->nullable();
            $table->foreignId('payment_method_id')->nullable()->constrained('payment_methods');
            $table->string('payment_code')->nullable();
            $table->decimal('payment_fee', 15, 4)->nullable()->default(0);
            $table->tinyInteger('payment_fee_type')->nullable()->default(0);
            $table->tinyInteger('payment_fee_method')->nullable();
            $table->text('comment')->nullable();
            $table->decimal('total_price', 15, 4)->default(0);
            $table->decimal('total_discount', 15, 4)->nullable()->default(0);
            $table->decimal('total_shipping', 15, 4)->default(0);
            $table->decimal('total', 15, 4)->default(0);
            $table->tinyInteger('status')->default(1);
            $table->foreignId('coupon_id')->nullable()->constrained('coupon_codes');
            $table->string('tracking')->nullable();
            $table->string('ip')->nullable();
            $table->string('forwarded_ip')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('accept_language')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
