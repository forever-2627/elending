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
use Carbon\Carbon;

if (!function_exists('setting')) {

    function setting()
    {
        $setting = Setting::where(['id' => 1])->first();
        if(!isset($setting)){
            $setting = [
                'interest_rate' => 5,
                'processing_fee' => 3,
                'staff_viewable_days' => 3
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
        $original_payment_start_date = clone $payment_start_date;
        $current_date = new DateTime(now());
        $interval_days = $current_date->diff($payment_start_date)->days;
        $payment_frequency = $loan->payment_frequency;
        $amount_repaid_to_date = $loan->amount_repaid_to_date;
        $payment_amount = $loan->payment_amount;
        switch ($payment_frequency){
            case 'weekly':
                $repayment_number = ($payment_start_date > $current_date) ? -1 : floor( $interval_days / 7 );
                $have_to_pay_amount = $payment_amount * ( $repayment_number + 1);
                $due_date = $payment_start_date->modify('+'. 7 * ( $repayment_number + 1) .' days');
                break;
            case 'fortnightly':
                $repayment_number =  ($payment_start_date > $current_date) ? -1 : floor( $interval_days / 14 );
                $have_to_pay_amount = $payment_amount * ( $repayment_number + 1);
                $due_date = $payment_start_date->modify('+'. 15 * ( $repayment_number + 1) .' days');
                break;
            case 'monthly':
                $repayment_number = ($payment_start_date > $current_date) ? -1 : floor( $interval_days / 30 );
                $have_to_pay_amount = $payment_amount * ( $repayment_number + 1);
                $due_date = $payment_start_date->modify('+'. ( $repayment_number + 1) .' month');
                break;
            default:
                $repayment_number =  ($payment_start_date > $current_date) ? -1 : floor( $interval_days / 7 );
                $have_to_pay_amount = $payment_amount * ( $repayment_number + 1);
                $due_date = $payment_start_date->modify('+'. 7 * ( $repayment_number + 1) .' days');
                break;
        }
//        if($loan->id == 102){
//            dd($payment_frequency);
//        }
        $due_amount = $have_to_pay_amount - $amount_repaid_to_date;
        $due_detail['repayment_number'] = ($original_payment_start_date > $current_date) ? 1 : $repayment_number + 2;
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

if (!function_exists('filter_by_date')) {

    function filter_by_date($items)
    {
        $filtered_items = [];
        $current_date = new DateTime(now());
        foreach ($items as $item){
            $updated_datetime = $item->updated_at;
            $interval_days = $current_date->diff($updated_datetime)->days;
            if( $interval_days < \setting()->staff_viewable_days ){
                $filtered_items[] = $item;
            }
        }
        return (object) $filtered_items;
    }
}

if (!function_exists('filter_by_user')) {

    function filter_by_user($items, $user_id, $type)
    {
        if(!$user_id){
            return $items;
        }
        $filtered_items = [];

        foreach ($items as $item){
            $item_user_id = $type == 'loan' ? $item->user_id : $item->user()->first()->id;
            if( $item_user_id == $user_id * 1 ){
                $filtered_items[] = $item;
            }
        }
        return (object) $filtered_items;
    }
}

if (!function_exists('filter_by_frequency')) {

    function filter_by_frequency($items, $frequency)
    {
        if(!$frequency || $frequency == 'all'){
            return $items;
        }
        $filtered_items = [];

        foreach ($items as $item){
            $item_frequency = $item->payment_frequency;
            if( $item_frequency == $frequency ){
                $filtered_items[] = $item;
            }
        }
        return (object) $filtered_items;
    }
}

if (!function_exists('track_loans')) {

    function track_loans($items)
    {
        $data = [];
        foreach ($items as $item){

            $plan = process_plan($item);
            $repayment = process_repayments($item);
            $data[] = [
                'user_id' => $item->user_id,
                'loan_number' => $item->id,
                'payment_frequency' => $item->payment_frequency,
                'total_to_be_repaid'=> $item->total_to_be_repaid,
                'plan' => $plan,
                'repayment' => $repayment,
            ];
        }

        return (object) $data;
    }
}

if (!function_exists('process_repayments')) {

    function process_repayments($item)
    {
        $data = [
            'total' => 0,
            'before' => 0,
            'previous' => [
                'name' => '',
                'values' => [0, 0, 0, 0]
            ],
            'current' => [
                'name' => '',
                'current_index' => 0,
                'values' => [0, 0, 0, 0]
            ],
            'next' => [
                'name' => '',
                'values' => [0, 0, 0, 0]
            ],
            'after' => 0,
            'status' => 0
        ];
        $repayments = $item->repayments;
        $current_date = Carbon::createFromFormat('m/d/Y', Carbon::now()->format('m/d/Y'));
        $current_month = Carbon::now()->format('m') * 1;
        $data['current']['current_index'] = calc_week($current_date->format('d') * 1);
        foreach ($repayments as $repayment){
            $repaid_date = Carbon::createFromFormat('m/d/Y', $repayment->repaid_date);
            $repaid_month = $repaid_date->format('m') * 1;
            $amount = $repayment->repaid_amount;

            if( $current_date >= $repaid_date){
                if( calc_month_dist($current_month - $repaid_month) > 1){
                    $data['before'] += $amount;
                    $data['total'] += $amount;
                }
                elseif (calc_month_dist($current_month - $repaid_month) == 1){
                    $data['previous']['name'] = $repaid_date->format('F');
                    $data['previous']['values'][calc_week($repaid_date->format('d') * 1)] += $amount;
                    $data['total'] += $amount;
                }
                elseif (calc_month_dist($current_month - $repaid_month) == 0){
                    if(calc_week($repaid_date->format('d') * 1) < $data['current']['current_index']) $data['total'] += $amount;
                    $data['current']['name'] = $repaid_date->format('F');
                    $data['current']['values'][calc_week($current_date->format('d') * 1)] += $amount;
                }
            }
            else{
                if( calc_month_dist($current_month - $repaid_month) == 0 ){
                    $data['current']['name'] = $repaid_date->format('F');
                    $data['current']['values'][calc_week($repaid_date->format('d') * 1)] += $amount;

                }
                elseif (calc_month_dist($current_month - $repaid_month) == 1){
                    $data['next']['name'] = $repaid_date->format('F');
                    $data['next']['values'][calc_week($repaid_date->format('d') * 1)] += $amount;
                }
                elseif (calc_month_dist($current_month - $repaid_month) > 1){
                    $data['after'] += $amount;
                }
            }

        }
        return $data;
    }
}

if (!function_exists('process_plan')) {

    function process_plan($item)
    {
        $data = [
            'total' => 0,
            'before' => 0,
            'previous' => [
                'name' => '',
                'values' => [0, 0, 0, 0]
            ],
            'current' => [
                'current_index' => 0,
                'name' => '',
                'values' => [0, 0, 0, 0]
            ],
            'next' => [
                'name' => '',
                'values' => [0, 0, 0, 0]
            ],
            'after' => 0,
            'status' => 0
        ];
        $plan_list = get_plan_list($item);

        $current_date = Carbon::createFromFormat('m/d/Y', Carbon::now()->format('m/d/Y'));
        $current_month = Carbon::now()->format('m') * 1;
        $tmp = [];
        $data['current']['current_index'] = calc_week($current_date->format('d') * 1);
        foreach ($plan_list as $plan){
            $plan = (object) $plan;
            $payment_date = $plan->payment_date;
            $payment_month = $payment_date->format('m') * 1;
            $amount = round($plan->payment_amount * 100) / 100;
            if( $current_date >= $payment_date ){
                if( calc_month_dist($current_month - $payment_month) > 1){
                    $data['total'] += $amount;
                    $data['before'] += $amount;
                }
                elseif (calc_month_dist($current_month - $payment_month) == 1){
                    $data['total'] += $amount;
                    $data['previous']['name'] = $payment_date->format('F');
                    $data['previous']['values'][calc_week($payment_date->format('d') * 1)] += $amount;
                }
                elseif (calc_month_dist($current_month - $payment_month) == 0){
                    if(calc_week($payment_date->format('d') * 1) <= $data['current']['current_index']) $data['total'] += $amount;
                    $data['current']['name'] = $payment_date->format('F');
                    $data['current']['values'][calc_week($payment_date->format('d') * 1)] += $amount;
                }
            }
            else{
                if( calc_month_dist(  $payment_month - $current_month) == 0 ){
                    if(calc_week($payment_date->format('d') * 1) <= $data['current']['current_index']) $data['total'] += $amount;
                    $data['current']['name'] = $payment_date->format('F');
                    $data['current']['values'][calc_week($payment_date->format('d') * 1)] += $amount;

                }
                elseif (calc_month_dist($payment_month - $current_month) == 1){
                    $data['next']['name'] = $payment_date->format('F');
                    $data['next']['values'][calc_week($payment_date->format('d') * 1)] += $amount;
                }
                elseif (calc_month_dist($payment_month - $current_month) > 1){
                    $data['after'] += $amount;
                }
            }
        }
        return $data;
    }
}

if (!function_exists('calc_month_dist')) {

    function calc_month_dist($distance)
    {
        return ($distance + 12) % 12;
    }
}

if (!function_exists('calc_week')) {

    function calc_week($day)
    {
        if($day >= 1 && $day < 8) return 0;
        elseif( $day >= 8 && $day < 16 ) return 1;
        elseif( $day >= 16 && $day < 24 ) return 2;
        elseif( $day >= 24 && $day <= 31 ) return 3;
    }
}

if (!function_exists('get_plan_list')) {

    function get_plan_list($loan)
    {
        $nof_payments = $loan->nof_payments;
        $payment_start_date = new DateTime($loan->payment_start_date);
        $original_payment_start_date = clone $payment_start_date;
        $payment_frequency = $loan->payment_frequency;
        $data[] = [
            'payment_date' => $original_payment_start_date,
            'payment_amount' => $loan->payment_amount
        ];
        for($i = 1; $i < $nof_payments; $i++){
            switch ($payment_frequency){
                case 'weekly':
                    $payment_date = clone $payment_start_date->modify('+'. 7 .' days');
                    break;
                case 'fortnightly':
                    $payment_date = clone $payment_start_date->modify('+'. 15 .' days');
                    break;
                case 'monthly':
                    $payment_date = clone $payment_start_date->modify('+'. 1 .' month');
                    break;
                default:
                    $payment_date = clone $payment_start_date->modify('+'. 7  .' days');
                    break;
            }
            $data[] = [
                'payment_date' => $payment_date,
                'payment_amount' => $loan->payment_amount
            ];
        }
        return $data;
    }
}

if(!function_exists('check_weekly_plan_badge')){
    function check_weekly_plan_badge($index, $current_index){
//        dd($current_index);
        if($index < $current_index) return 'bg-dark';
        else if ($index == $current_index) return 'bg-primary';
        else return 'bg-secondary';
    }
}

if(!function_exists('check_weekly_repayment_badge')){
    function check_weekly_repayment_badge($index, $current_index){
        if($index < $current_index) return 'bg-success';
        else if ($index == $current_index) return 'bg-danger';
        else if($index > $current_index) return 'bg-warning';
    }
}

if(!function_exists('check_fortnightly_plan_badge')){
    function check_fortnightly_plan_badge($index, $current_index){
        if(in_array($current_index, $index, true)) return 'bg-primary';
        else if(in_array($current_index, [0, 1], true)) return 'bg-secondary';
        else return 'bg-dark';
    }
}

if(!function_exists('check_fortnightly_repayment_badge')){
    function check_fortnightly_repayment_badge($index, $current_index){
        if(in_array($current_index, $index, true)) return 'bg-danger';
        else if(in_array($current_index, [0, 1], true)) return 'bg-warning';
        else return 'bg-success';
    }
}