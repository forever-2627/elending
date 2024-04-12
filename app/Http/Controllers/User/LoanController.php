<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(Request $request){
        $loans = Loan::where(['user_id' => $request->user()->id])->get();
        return view('frontend.dashboard.loans', ['loans' => $loans]);
    }
}
