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
            'loan_amount_graph' => $this->loan->loan_amount_graph(),
            'new_loans_graph' => $this->loan->new_loans_graph(),
            'repayments_graph' => $this->loan->repayments_graph(),
            'outstanding_balance_graph' => $this->loan->outstanding_balance_graph(),
            'issued_loan_graph' => $this->loan->issued_loan_graph(),
            'repaid_loans_graph' => $this->loan->repaid_loans_graph(),
            'payable_graph' => $this->loan->payable_graph()
        ];
        return view('admin.index', $data);
    }
}
