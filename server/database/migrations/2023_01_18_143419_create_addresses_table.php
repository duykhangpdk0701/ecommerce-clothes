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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('country_id')->nullable()->references('id')->on('sys_countries');
            $table->foreignId('city_id')->nullable()->references('id')->on('sys_cities');
            $table->foreignId('district_id')->nullable()->references('id')->on('sys_districts');
            $table->foreignId('ward_id')->nullable()->references('id')->on('sys_wards');
            $table->string('address', 255)->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('addresses');
    }
};
