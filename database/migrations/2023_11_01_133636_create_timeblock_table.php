<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('time_blocks', function (Blueprint $table) {
            $table->id();
			$table->dateTime('start_time');
			$table->dateTime('stop_time');
            $table->string('name');
            $table->string('description')->nullable();
			$table->unsignedBigInteger('color_id');
			$table->foreign('color_id')->references('id')->on('colors');
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_blocks');
    }
};
