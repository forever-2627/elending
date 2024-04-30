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
        'outstanding_balance',
        'initial_total_to_be_repaid',
        'state'
    ];

    protected $visible = [
        'user_id',
        'loan_amount',
    ];

    public static function boot(){
        parent::boot();

        static::deleting(function($loan){
            $loan->repayments()->delete();
        });
    }

    public function repayments(){
        return $this->hasMany(Repayment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function loan_state(){
        return $this->belongsTo(LoanState::class);
    }

    public function get_total_loaned(){
        return Loan::sum('total_to_be_repaid');
    }

    public function get_delinquent_loans(){
        return 123;
    }

    public function get_total_outstanding_loans(){
        return Loan::sum('outstanding_balance');
    }

    public function get_current_month_payment(){
        $current_month = date('m');
        return 12345;
    }

    public function get_current_month_loaned(){
        return 12345;
    }
}
