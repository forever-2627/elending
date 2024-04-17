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
        'payment_frequency',
        'nof_payments',
        'payment_start_date',
        'payment_amount',
        'total_to_be_repaid',
        'amount_repaid_to_date',
        'outstanding_balance'
    ];

    public function get_total_loaned(){
        return 1234;
    }

    public function get_delinquent_loans(){
        return 123;
    }

    public function get_total_outstanding_loans(){
        return 12345;
    }

    public function get_current_month_payment(){
        return 12345;
    }

    public function get_current_month_loaned(){
        return 12345;
    }
}
