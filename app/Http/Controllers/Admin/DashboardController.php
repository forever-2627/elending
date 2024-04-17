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
            'total_loaned' => $this->loan->get_total_loaned(),
            'delinquent_loans' => $this->loan->get_delinquent_loans(),
            'total_outstanding_loans' => $this->loan->get_total_outstanding_loans(),
            'current_month_payment' => $this->loan->get_current_month_payment(),
            'current_month_loans' => $this->loan->get_total_outstanding_loans()
        ];
        return view('admin.index', $data);
    }
}
