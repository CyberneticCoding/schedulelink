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
		Schema::table('users', function (Blueprint $table) {
			$table->unsignedBigInteger('active_company_id')->nullable();
			$table->foreign('active_company_id')->references('id')->on('companies')->onDelete('set null');
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
		Schema::table('users', function (Blueprint $table) {
			$table->dropForeign(['active_company_id']);
			$table->dropColumn('active_company_id');
		});
    }
};
