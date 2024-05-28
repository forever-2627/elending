<?php
/**
 * Created by PhpStorm.
 * User: 585
 * Date: 4/28/2024
 * Time: 12:28 PM
 */

use App\Models\Setting;
use App\Models\Loan;
use App\Models\User;

if (!function_exists('setting')) {

    function setting()
    {
        $setting = Setting::where(['id' => 1])->first();
        if(!isset($setting)){
            $setting = [
                'interest_rate' => 5,
                'processing_fee' => 3
            ];
        }
        return $setting;
    }
}

if (!function_exists('get_loan_amount')) {

    function get_loan_amount($type)
    {
        $loan_amount = (object)[
            'loan_amount' => 0,
            'total_to_be_repaid' => 0,
            'amount_repaid_to_date' => 0,
            'outstanding_balance' => 0
        ];
        switch ($type){
            case 'all':
                $loans =  Loan::orderBy('created_at', 'desc')->get();
                break;
            case 'active':
                $loans =  Loan::where(['state' => 1])->orderBy('created_at', 'desc')->get();
                break;
            case 'repaid':
                $loans =  Loan::where(['state' => 2])->orderBy('created_at', 'desc')->get();
                break;
            case 'bad':
                $loans =  Loan::where(['state' => 3])->orderBy('created_at', 'desc')->get();
                break;
            default:
                $loans =  Loan::orderBy('created_at', 'desc')->get();
                break;
        }

        foreach ($loans as $loan){
            $loan_amount->loan_amount += $loan->loan_amount;
            $loan_amount->amount_repaid_to_date += $loan->amount_repaid_to_date;
            $loan_amount->outstanding_balance += $loan->outstanding_balance;
            $loan_amount->total_to_be_repaid += $loan->total_to_be_repaid;
        }
        return $loan_amount;
    }
}

if (!function_exists('money_formatting')) {

    function money_formatting($number)
    {
        $formatted_number = number_format($number,2, '.', ' ');
        return $formatted_number;
    }
}

if (!function_exists('get_due_detail')) {

    function get_due_detail($loan)
    {
        $due_detail = [];
        $payment_start_date = new DateTime($loan->payment_start_date);
        $current_date = new DateTime(now());
        $interval_days = $current_date->diff($payment_start_date)->days;
        $payment_frequency = $loan->payment_frequency;
        $amount_repaid_to_date = $loan->amount_repaid_to_date;
        $payment_amount = $loan->payment_amount;
        switch ($payment_frequency){
            case 'weekly':
                $repayment_number = ($payment_start_date > $current_date) ? -1 : floor( $interval_days / 7 );
                $have_to_pay_amount = $payment_amount * ( $repayment_number + 1);
                $due_date = $payment_start_date->modify('+'. 7 * $repayment_number .' days');
                break;
            case 'fortnightly':
                $repayment_number =  ($payment_start_date > $current_date) ? -1 : floor( $interval_days / 14 );
                $have_to_pay_amount = $payment_amount * ( $repayment_number + 1);
                $due_date = $payment_start_date->modify('+'. 7 * $repayment_number .' days');
                break;
            case 'monthly':
                $repayment_number = ($payment_start_date > $current_date) ? -1 : floor( $interval_days / 30 );
                $have_to_pay_amount = $payment_amount * ( $repayment_number + 1);
                $due_date = $payment_start_date->modify('+'. $repayment_number .' month');
                break;
            default:
                $repayment_number =  ($payment_start_date > $current_date) ? -1 : floor( $interval_days / 7 );
                $have_to_pay_amount = $payment_amount * ( $repayment_number + 1);
                $due_date = $payment_start_date->modify('+'. $repayment_number .' days');
                break;
        }
        $due_amount = $have_to_pay_amount - $amount_repaid_to_date;
        $due_detail['repayment_number'] = ($payment_start_date > $current_date) ? 0 : $repayment_number + 1;
        $due_detail['amount'] = $due_amount < 0 ? 0 : $due_amount;
        $due_detail['due_date'] = $due_date->format('m/d/Y');
        return (object)$due_detail;
    }
}

if (!function_exists('get_username')) {

    function get_username($id)
    {
        $user = User::find($id);
        $username = $user->given_name . ' ' . $user->surname;
        return $username;
    }
}
