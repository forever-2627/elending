<?php

namespace App\Http\Controllers\Staff;

use App\Events\RepaymentUpdated;
use App\Http\Controllers\Controller;
use App\Models\Repayment;
use Illuminate\Http\Request;

class RepaymentController extends Controller
{
    public function index(Request $request){
        $repayments = Repayment::all();
        return view('backend.repayments.all_repayment', ['repayments' => $repayments]);
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
        try{
            $repayment->update();
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
        try{
            $repayment->delete();
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
