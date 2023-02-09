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
        Schema::create('view_activities', function (Blueprint $table) {
            $table->id();
            $table->morphs('viewable');
            $table->string('user_id')->nullable();
            $table->string('user_email')->nullable();
            $table->string('user_activity')->nullable();
            $table->string('tracking')->nullable();
            $table->string('ip')->nullable();
            $table->string('forwarded_ip')->nullable();
            $table->string('user_agent')->nullable();
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
        Schema::dropIfExists('view_activities');
    }
};
