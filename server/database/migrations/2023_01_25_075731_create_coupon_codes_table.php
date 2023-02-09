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
        Schema::create('coupon_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code', 32)->nullable()->unique();
            $table->foreignId('coupon_code_events_id')->nullable()->constrained();
            $table->tinyInteger('status')->default(1);
            $table->integer('count')->default(0);
            $table->integer('limit')->default(0);
            $table->tinyInteger('use_repeat')->default(0);
            $table->double('amount', 13, 2);
            $table->tinyInteger('amount_type')->default(1);
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
        Schema::dropIfExists('coupon_codes');
    }
};
