<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;

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

    public function active_loan_amount(){
        return Loan::where(['state' => 1])->sum('loan_amount');
    }

    public function current_month_new_loans(){
        $amount = 0;
        $current_year = now()->year;
        $current_month = now()->month;
        $loans = Loan::whereRaw('MONTH(str_to_date(payment_start_date, "%m/%d/%Y")) = ?', [$current_month])->
            whereRaw('YEAR(str_to_date(payment_start_date, "%m/%d/%Y")) = ?', [$current_year])->get();
        foreach ($loans as $loan){
            $amount += $loan->loan_amount;
        }
        return $amount;
    }

    public function current_month_repayments(){
        $amount = 0;
        $current_year = now()->year;
        $current_month = now()->month;
        $repayments = Repayment::whereRaw('MONTH(str_to_date(repaid_date, "%m/%d/%Y")) = ?', [$current_month])->
        whereRaw('YEAR(str_to_date(repaid_date, "%m/%d/%Y")) = ?', [$current_year])->get();
        foreach ($repayments as $repayment){
            $amount += $repayment->repaid_amount;
        }
        return $amount;
    }

    public function all_outstanding_loans(){
        return Loan::sum('outstanding_balance');;
    }

    public function get_issued_loan_amount(){
        $amount = 0;
        $loans = Loan::where(['state' => 1])->orWhere(['state' => 2])->get();
        foreach ($loans as $loan){
            //Date Type is mm/dd/yyyy
            $payment_start_date = new DateTime($loan->payment_start_date);
            $current_date = new DateTime(now());
            $interval_days = $current_date->diff($payment_start_date)->days;
            $payment_frequency = $loan->payment_frequency;
            $amount_repaid_to_date = $loan->amount_repaid_to_date;
            $payment_amount = $loan->payment_amount;
            switch ($payment_frequency){
                case 'weekly':
                    $have_to_pay_amount = $payment_amount * round( $interval_days / 7 );
                    break;
                case 'fortnightly':
                    $have_to_pay_amount = $payment_amount * round( $interval_days / 14 );
                    break;
                case 'monthly':
                    $have_to_pay_amount = $payment_amount * round( $interval_days / 30 );
                    break;
                default:
                    $have_to_pay_amount = $payment_amount * round( $interval_days / 7 );
                    break;
            }
            if($amount_repaid_to_date < $have_to_pay_amount){
                $amount += $have_to_pay_amount - $amount_repaid_to_date;
            }
        }
        return $amount;
    }

    public function repaid_loans(){
        $amount = 0;
        $loans = Loan::where(['state' => 2])->get();
        foreach ($loans as $loan){
            $amount += $loan->total_to_be_repaid;
        }
        return $amount;
    }
}
