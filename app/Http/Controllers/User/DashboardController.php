<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $loans = Loan::where(['user_id' => Auth::user()->id])->get();
        return view('frontend.dashboard.dashboard',  ['loans' => $loans]);
    }
}
