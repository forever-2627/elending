<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(){
        $loans = Loan::all();
        return view('backend.loans.all_loan', ['loans' => $loans]);
    }

    public function store(Request $request){
        $user_id = $request->user_id;
        $loan_amount = $request->loan_amount;
        $payment_frequency = $request->payment_frequency;
        $nof_payments = $request->nof_payments;
        $payment_start_date = $request->payment_start_date;
        $payment_amount = $request->payment_amount;
        $total_to_be_repaid = $request->total_to_be_repaid;
        $amount_repaid_to_date = $request->amount_repaid_to_date;
        $outstanding_balance = $request->outstanding_balance;
        try{
            Loan::create([
                'user_id' => $user_id,
                'loan_amount' => $loan_amount,
                'payment_frequency' => $payment_frequency,
                'nof_payments' => $nof_payments,
                'payment_start_date' => $payment_start_date,
                'payment_amount' => $payment_amount,
                'total_to_be_repaid' => $total_to_be_repaid,
                'amount_repaid_to_date' => $amount_repaid_to_date,
                'outstanding_balance' => $outstanding_balance
            ]);
        }
        catch (\Exception $e){
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect(route('staff.loans.create'))->with($notification);
        }
        $notification = [
            'message' => 'Loan Added Successfully',
            'alert-type' => 'success'
        ];
        return redirect(route('staff.loans'))->with($notification);
    }

    public function create(){
        return view('backend.loans.add_loan');
    }

    public function edit($id){
        $loan = Loan::find($id);
        $user = User::find($loan->user_id);
        return view('backend.loans.edit_loan', ['loan' => $loan, 'selected_user'=>$user]);
    }

    public function update(Request $request){
        $loan = Loan::find($request->loan_id);
        $user_id = $request->user_id;
        $loan_amount = $request->loan_amount;
        $payment_frequency = $request->payment_frequency;
        $nof_payments = $request->nof_payments;
        $payment_start_date = $request->payment_start_date;
        $payment_amount = $request->payment_amount;
        $total_to_be_repaid = $request->total_to_be_repaid;
        $amount_repaid_to_date = $request->amount_repaid_to_date;
        $outstanding_balance = $request->outstanding_balance;
        try{
            $loan->update([
                'user_id' => $user_id,
                'loan_amount' => $loan_amount,
                'payment_frequency' => $payment_frequency,
                'nof_payments' => $nof_payments,
                'payment_start_date' => $payment_start_date,
                'payment_amount' => $payment_amount,
                'total_to_be_repaid' => $total_to_be_repaid,
                'amount_repaid_to_date' => $amount_repaid_to_date,
                'outstanding_balance' => $outstanding_balance
            ]);
        }
        catch (\Exception $e){
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect(route('staff.loans.create'))->with($notification);
        }
        $notification = [
            'message' => 'Loan Added Successfully',
            'alert-type' => 'success'
        ];
        return redirect(route('staff.loans'))->with($notification);
    }

    public function view($id){
        $loan = Loan::find($id);
        $user = User::find($loan->user_id);
        return view('backend.loans.details_loan', ['loan' => $loan, 'user'=>$user]);
    }

    public function delete($id){
        $loan = Loan::find($id);
        try{
            $loan->delete();
        }
        catch (\Exception $e){
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect(route('staff.loans'))->with($notification);
        }
        $notification = [
            'message' => 'Loan Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect(route('staff.loans'))->with($notification);
    }
}
