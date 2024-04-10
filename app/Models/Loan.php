<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'sequence_number',
        'user_id',
        'loan_amount',
        'loan_issued',
        'payment_frequency',
        'nof_payments',
        'payment_start_date',
        'payment_amount',
        'total_to_be_repaid',
        'amount_repaid_to_date',
        'outstanding_balance'
    ];
}
