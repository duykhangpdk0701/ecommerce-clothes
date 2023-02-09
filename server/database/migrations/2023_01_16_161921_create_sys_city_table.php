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
        Schema::create('sys_cities', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->mediumText('geometry')->nullable();
            $table->string('center')->nullable();
            $table->string('color')->nullable();
            $table->string('bounding_box')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('pre')->nullable();
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
        Schema::dropIfExists('sys_city');
    }
};
