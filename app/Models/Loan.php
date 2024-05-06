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

    public $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

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

    public function due_loans(){
        return $this->hasMany(DueLoan::class);
    }

    public function active_loan_amount(){
        $amount = 0;
        $loans = Loan::where(['state' => 1])->get();
        foreach ($loans as $loan){
            $amount += $loan->loan_amount;
        }
        return $amount;
    }

    public function current_month_new_loans(){
        $amount = 0;
        $current_year = now()->year;
        $current_month = now()->month;
        $loans = Loan::whereRaw('MONTH(str_to_date(payment_start_date, "%m/%d/%Y")) = ?', [$current_month])->
        whereRaw('YEAR(str_to_date(payment_start_date, "%m/%d/%Y")) = ?', [$current_year])
            ->where(['state' => 1])->get();
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
        return Loan::sum('outstanding_balance');
    }

    public function get_issued_loan_amount(){
        $amount = 0;
        if(count($this->get_issued_loans()) > 0) {
            $issued_loan_amounts = $this->get_issued_loans()['amount'];
            foreach ($issued_loan_amounts as $issued_loan_amount) {
                $amount += $issued_loan_amount;
            }
        }
        return $amount;
    }

    public function get_issued_loans(){
        $issued_loans = array();
        $loans = Loan::where(['state' => 1])->orWhere(['state' => 3])->get();//get loans active or bad
        foreach ($loans as $loan){
            //Date Type is mm/dd/yyyy
            $payment_start_date = new DateTime($loan->payment_start_date);
            $current_date = new DateTime(now());
            if($payment_start_date >= $current_date) continue;
            $interval_days = $current_date->diff($payment_start_date)->days;
            $payment_frequency = $loan->payment_frequency;
            $amount_repaid_to_date = $loan->amount_repaid_to_date;
            $payment_amount = $loan->payment_amount;
            switch ($payment_frequency){
                case 'weekly':
                    $interval_weeks =  round( $interval_days / 7 );
                    $have_to_pay_amount = $payment_amount * $interval_weeks;
                    $due_date = $payment_start_date->modify('+'. 7 * $interval_weeks .' days');
                    break;
                case 'fortnightly':
                    $interval_weeks =  round( $interval_days / 14 );
                    $have_to_pay_amount = $payment_amount * $interval_weeks;
                    $due_date = $payment_start_date->modify('+'. 7 * $interval_weeks .' days');
                    break;
                case 'monthly':
                    $interval_month = round( $interval_days / 30 );
                    $have_to_pay_amount = $payment_amount * $interval_month;
                    $due_date = $payment_start_date->modify('+'. $interval_month .' month');
                    break;
                default:
                    $interval_weeks =  round( $interval_days / 7 );
                    $have_to_pay_amount = $payment_amount * $interval_weeks;
                    $due_date = $payment_start_date->modify('+'. $interval_weeks .' days');
                    break;
            }
            if($due_date >= $current_date) continue;
            if($amount_repaid_to_date < $have_to_pay_amount){
                $issued_loans['loan_id'][] = $loan->id;
                $issued_loans['amount'][] = $amount_repaid_to_date;
                $issued_loans['due_date'][] = $due_date->format('m/d/Y');;
            }
        }
        return $issued_loans;
    }

    public function repaid_loans(){
        $amount = 0;
        $loans = Loan::where(['state' => 2])->get();
        foreach ($loans as $loan){
            $amount += $loan->total_to_be_repaid;
        }
        return $amount;
    }

    public function loan_amount_graph(){
        $loan_amount_graph = array();
        $current_year = now()->year;
        for ($i = 0; $i < 12; $i++){
            $loans = Loan::whereRaw('MONTH(str_to_date(payment_start_date, "%m/%d/%Y")) = ?', [$i + 1])->
            whereRaw('YEAR(str_to_date(payment_start_date, "%m/%d/%Y")) = ?', [$current_year])
                ->where(['state' => 1])->get();
            $loan_amount_graph['labels'][] = $this->months[$i];
            $loan_amount_graph['values'][] = 0;
            foreach ($loans as $loan){
                $loan_amount_graph['values'][$i] += $loan->loan_amount;
            }
        }
        return $loan_amount_graph;
    }

    public function new_loans_graph(){
        $new_loans_graph = array();
        $current_year = now()->year;
        for ($i = 0; $i < 12; $i++){
            $loans = Loan::whereRaw('MONTH(str_to_date(payment_start_date, "%m/%d/%Y")) = ?', [$i + 1])->
            whereRaw('YEAR(str_to_date(payment_start_date, "%m/%d/%Y")) = ?', [$current_year])->get();
            $new_loans_graph['labels'][] = $this->months[$i];
            $new_loans_graph['values'][] = 0;
            foreach ($loans as $loan){
                $new_loans_graph['values'][$i] += $loan->loan_amount;
            }
        }
        return $new_loans_graph;
    }

    public function repayments_graph(){
        $repayments_graph = array();
        $current_year = now()->year;
        for ($i = 0; $i < 12; $i++){
            $repayments = Repayment::whereRaw('MONTH(str_to_date(repaid_date, "%m/%d/%Y")) = ?', [$i + 1])->
            whereRaw('YEAR(str_to_date(repaid_date, "%m/%d/%Y")) = ?', [$current_year])->get();
            $repayments_graph['labels'][] = $this->months[$i];
            $repayments_graph['values'][] = 0;
            foreach ($repayments as $repayment){
                $repayments_graph['values'][$i] += $repayment->repaid_amount;
            }
        }
        return $repayments_graph;
    }

    public function outstanding_balance_graph(){
        $outstanding_balance_graph = array();
        $current_year = now()->year;
        for ($i = 0; $i < 12; $i++){
            $loans = Loan::whereRaw('MONTH(str_to_date(payment_start_date, "%m/%d/%Y")) = ?', [$i + 1])->
            whereRaw('YEAR(str_to_date(payment_start_date, "%m/%d/%Y")) = ?', [$current_year])->get();
            $outstanding_balance_graph['labels'][] = $this->months[$i];
            $outstanding_balance_graph['values'][] = 0;
            foreach ($loans as $loan){
                $outstanding_balance_graph['values'][$i] += $loan->outstanding_balance;
            }
        }
        return $outstanding_balance_graph;
    }

    //Issued Loans Graph
    public function issued_loan_graph(){
        $issued_loan_graph = array();
        $current_year = now()->year;
        for ($i = 0; $i < 12; $i++){
            $issued_loan_graph['labels'][] = $this->months[$i];
            $issued_loan_graph['values'][] = 0;
        }
        if(count($this->get_issued_loans()) > 0) {
            $issued_loan_ids = $this->get_issued_loans()['loan_id'];
            $issued_loan_amounts = $this->get_issued_loans()['amount'];
            foreach ($issued_loan_ids as $key => $issued_loan_id){
                $loan = Loan::find($issued_loan_id);
                $payment_start_year = explode('/', $loan->payment_start_date)[2];
                $payment_start_month = explode('/', $loan->payment_start_date)[0];
                if($current_year == $payment_start_year){
                    $issued_loan_graph['values'][$payment_start_month * 1 - 1] += $issued_loan_amounts[$key];
                }
            }
        }
        return $issued_loan_graph;
    }

    //Repaid Loans Amount
    public function repaid_loans_graph(){
        $repaid_loans_graph = array();
        $current_year = now()->year;
        for ($i = 0; $i < 12; $i++){
            $loans = Loan::whereRaw('MONTH(str_to_date(payment_start_date, "%m/%d/%Y")) = ?', [$i + 1])->
            whereRaw('YEAR(str_to_date(payment_start_date, "%m/%d/%Y")) = ?', [$current_year])
                ->where(['state' => 2])->get();
            $repaid_loans_graph['labels'][] = $this->months[$i];
            $repaid_loans_graph['values'][] = 0;
            foreach ($loans as $loan){
                $repaid_loans_graph['values'][$i] += $loan->amount_repaid_to_date;
            }
        }
        return $repaid_loans_graph;
    }

    //Get Payable Amount
    public function payable_graph(){
        $payable_amounts = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $active_loans = Loan::where(['state' => 1])->get();
        foreach ($active_loans as $active_loan){
            $payment_frequency = $active_loan->payment_frequency;
            $payment_amount = $active_loan->payment_amount;
            $payment_start_date = DateTime::createFromFormat('m/d/Y', $active_loan->payment_start_date);
            $nof_payments = $active_loan->nof_payments;
            for($i = 0; $i < $nof_payments * 1; $i++){
                $payment_date = $payment_start_date->modify('+'. 7 * $i .' days');
            }
        }
    }
}
