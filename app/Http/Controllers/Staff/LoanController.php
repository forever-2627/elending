<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Support\Facades\Auth;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use function PHPUnit\Framework\MockObject\object;

class LoanController extends Controller
{
    public function index(Request $request, $state){
        switch ($state){
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

        $user_id = $request->user_id;
        if($user_id){
            $filtered_loans = filter_by_user($loans, $user_id, 'loan');
            return view('backend.loans.all_loan', ['loans' => $filtered_loans, 'state' => $state, 'user_id' => $user_id]);
        }
        else{
            $filtered_loans = auth()->user()->role_id != config('constants.roles.admin_role_id') ? filter_by_date($loans) : $loans;
            return view('backend.loans.all_loan', ['loans' => $filtered_loans, 'state' => $state, 'user_id' => $user_id]);
        }
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
        $initial_total_to_be_repaid = $total_to_be_repaid - $amount_repaid_to_date;
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
                'outstanding_balance' => $outstanding_balance,
                'initial_total_to_be_repaid' => $initial_total_to_be_repaid,
                'state' => 1,
                'by_who' => Auth::user()->id
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
        return redirect(route('staff.loans', ['state' => 'all']))->with($notification);
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
        $initial_total_to_be_repaid = $total_to_be_repaid - $amount_repaid_to_date;
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
                'outstanding_balance' => $outstanding_balance,
                'initial_total_to_be_repaid' => $initial_total_to_be_repaid,
                'by_who' => Auth::user()->id
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
        return redirect(route('staff.loans', ['state' => 'all']))->with($notification);
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
            return redirect(route('staff.loans', ['state' => 'all']))->with($notification);
        }
        $notification = [
            'message' => 'Loan Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect(route('staff.loans', ['state' => 'all']))->with($notification);
    }

    public function change_state($loan_id, $state){
        $loan = Loan::find($loan_id);
        $loan->state = $state;
        try{
            $loan->update();
        }
        catch (\Exception $e){
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
        $notification = [
            'message' => 'Loan Status Changed Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
}
