<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedLoan extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'employer_name',
        'occupation',
        'loan_amount',
        'loan_period',
        'address',
        'phone_number',
        'repayment_amount',
        'payment_start_date',
        'payment_frequency',
        'loan_purpose',
        'user_created',
        'loan_created'
    ];
}
