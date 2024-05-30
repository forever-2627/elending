<?php

namespace App\Http\Controllers\Staff;

use App\Events\RepaymentUpdated;
use App\Http\Controllers\Controller;
use App\Models\Repayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepaymentController extends Controller
{
    public function index(Request $request){
        $repayments = Repayment::orderBy('created_at', 'desc')->get();

        $user_id = $request->user_id;
        if($user_id){
            $filtered_repayments = filter_by_user($repayments, $user_id, 'repayment');
            return view('backend.repayments.all_repayment', ['repayments' => $filtered_repayments, 'user_id' => $user_id]);
        }
        else{
            $filtered_repayments = auth()->user()->role_id != config('constants.roles.admin_role_id') ? filter_by_date($repayments) : $repayments;
            return view('backend.repayments.all_repayment', ['repayments' => $filtered_repayments, 'user_id' => $user_id]);
        }

    }

    public function create(){
        return view('backend.repayments.add_repayment');
    }

    public function store(Request $request){
        $loan_id = $request->loan_id;
        $repaid_date = $request->repaid_date;
        $repaid_amount = $request->repaid_amount;

        try{
            Repayment::create([
                'loan_id' => $loan_id,
                'repaid_date'=>$repaid_date,
                'repaid_amount' => $repaid_amount,
                'by_who' => Auth::user()->id
            ]);
        }
        catch (\Exception $e){
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect(route('staff.repayments.create'))->with($notification);
        }
        $notification = [
            'message' => 'Repayment Added Successfully',
            'alert-type' => 'success'
        ];

        RepaymentUpdated::dispatch($loan_id);
        return redirect(route('staff.repayments'))->with($notification);
    }

    public function edit($id){
        $repayment = Repayment::find($id);

        return view('backend.repayments.edit_repayment', ['repayment' => $repayment]);
    }

    public function update(Request $request){
        $repayment_id = $request->repayment_id;
        $repayment = Repayment::find($repayment_id);
        $repayment->loan_id = $request->loan_id;
        $repayment->repaid_date = $request->repaid_date;
        $repayment->repaid_amount = $request->repaid_amount;
        $repayment->by_who = Auth::user()->id;
        try{
            $repayment->update();
            RepaymentUpdated::dispatch($repayment->loan_id);
        }
        catch (\Exception $e){
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect(route('staff.repayments.edit', $repayment_id))->with($notification);
        }
        $notification = [
            'message' => 'Repayment Information Updated Successfully',
            'alert-type' => 'success'
        ];
        return redirect(route('staff.repayments'))->with($notification);
    }

    public function delete($repayment_id){
        $repayment = Repayment::find($repayment_id);
        $loan_id = $repayment->loan_id;
        try{
            $repayment->delete();
            RepaymentUpdated::dispatch($loan_id);
        }
        catch (\Exception $e){
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect(route('staff.repayments'))->with($notification);
        }
        $notification = [
            'message' => 'Repayment History Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect(route('staff.repayments'))->with($notification);
    }
}
