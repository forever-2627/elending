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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('payment_frequency');
            $table->string('loan_amount');
            $table->string('loan_issued');
            $table->integer('nof_payments');
            $table->string('payment_start_date');
            $table->string('payment_amount');
            $table->string('total_to_be_repaid');
            $table->string('amount_repaid_to_date');
            $table->string('outstanding_balance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
