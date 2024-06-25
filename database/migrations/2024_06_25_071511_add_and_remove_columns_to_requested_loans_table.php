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
        Schema::table('requested_loans', function (Blueprint $table) {
            $table->dropColumn('is_first_loan');
            $table->string('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('requested_loans', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->string('is_first_loan');
        });
    }
};
