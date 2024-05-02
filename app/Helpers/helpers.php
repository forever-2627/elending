<?php
/**
 * Created by PhpStorm.
 * User: 585
 * Date: 4/28/2024
 * Time: 12:28 PM
 */

use App\Models\Setting;
use App\Models\Loan;

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
        }
        return $loan_amount;
    }
}
