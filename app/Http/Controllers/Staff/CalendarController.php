<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\DueLoan;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    private $due_loan;

    public function __construct()
    {
        $this->due_loan = new DueLoan();
    }

    public function index(){
        $this->due_loan->update_table();
        $current_date = date('m/d/Y');
        $due_loans = DueLoan::where(['current_date' => $current_date])->orderBy('is_paid', 'asc')->get();
        return view('admin.calendar', ['due_loans' => $due_loans]);
    }

    public function mark($id){
        $due_loan = DueLoan::find($id);
        $due_loan->is_paid = 1;
        try{
            $due_loan->update();
        }
        catch (\Exception $e){
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
        $notification = [
            'message' => 'This Loan Marked as Paid Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
}
