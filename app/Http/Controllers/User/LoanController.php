<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanRequestedEmail;
use App\Models\RequestedLoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class LoanController extends Controller
{
    public function index(Request $request){
        $loans = Loan::where(['user_id' => $request->user()->id])->get();
        return view('frontend.dashboard.loans', ['loans' => $loans]);
    }

    public function request_loan($token){
        try{
            $email = Crypt::decrypt($token);
        }catch (\Exception $e){
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect(route('home'))->with($notification);
        }

        $count = LoanRequestedEmail::where(['email' => $email])->count();
        if($count > 0){
            return view('frontend.dashboard.loan_request', ['email' => $email]);
        }
        else{
            $notification = [
                'message' => 'We can\'t find your email address. Please check your link is correct.',
                'alert-type' => 'error'
            ];
            return redirect(route('home'))->with($notification);
        }
    }

    public function store_requested_loan(Request $request){
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $employer_name = $request->employer_name;
        $occupation = $request->occupation;
        $loan_amount = $request->loan_amount;
        $loan_period = $request->loan_period;
        $address = $request->address;
        $phone_number = $request->phone_number;
        $repayment_amount = $request->repayment_amount;
        $payment_start_date = $request->payment_start_date;
        $payment_frequency = $request->payment_frequency;
        $loan_purpose = $request->loan_purpose;
        $email = $request->email;
        $interests = 0.05 * $loan_amount * $loan_period;
        $processing_fee = 0.03 * $loan_amount;
        $total_amount = $loan_amount + $interests + $processing_fee;
        if(round($total_amount) != round($repayment_amount)){
            $notification = [
                'message' => 'Please check you inputted repayment amount correct.',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }else{
            try{
                RequestedLoan::updateOrCreate(['email' => $email],[
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'employer_name' => $employer_name,
                    'occupation' => $occupation,
                    'loan_amount' => $loan_amount,
                    'loan_period' => $loan_period,
                    'address' => $address,
                    'phone_number' => $phone_number,
                    'repayment_amount' => $repayment_amount,
                    'payment_start_date' => $payment_start_date,
                    'payment_frequency' => $payment_frequency,
                    'loan_purpose' => $loan_purpose,
                    'user_created' => 0,
                    'loan_created' => 0
                ]);
                $notification = [
                    'message' => 'New loan requested successfully. Please wait response.',
                    'alert-type' => 'success'
                ];
                return redirect(route('home'))->with($notification);
            }
            catch(\Exception $e){
                $notification = [
                    'message' => $e->getMessage(),
                    'alert-type' => 'error'
                ];
                return redirect()->back()->with($notification);
            }
        }
    }

}
