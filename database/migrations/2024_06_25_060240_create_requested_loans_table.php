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
        Schema::create('requested_loans', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('employer_name');
            $table->string('occupation');
            $table->string('loan_amount');
            $table->string('loan_period');
            $table->string('address');
            $table->string('phone_number');
            $table->string('repayment_amount');
            $table->string('payment_start_date');
            $table->string('payment_frequency');
            $table->text('loan_purpose');
            $table->tinyInteger('is_first_loan');
            $table->tinyInteger('user_created');
            $table->tinyInteger('loan_created');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requested_loans');
    }
};
