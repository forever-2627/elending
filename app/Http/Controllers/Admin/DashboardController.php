<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $loan;

    public function __construct()
    {
        $this->loan = new Loan();
    }

    public function index(){
        $data = [
            'active_loan_amount' => $this->loan->active_loan_amount(),
            'current_month_new_loans' => $this->loan->current_month_new_loans(),
            'current_month_repayments' => $this->loan->current_month_repayments(),
            'all_outstanding_loans' => $this->loan->all_outstanding_loans(),
            'issued_loan_amount' => $this->loan->get_issued_loan_amount(),
            'repaid_loans' => $this->loan->repaid_loans(),
            'loan_amount_graph' => $this->loan->loan_amount_graph()
        ];
        return view('admin.index', $data);
    }
}
