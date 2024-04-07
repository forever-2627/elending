<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(){
        return view('backend.loans.all_loan');
    }

    public function create(){
        return view('backend.loans.add_loan');
    }

    public function edit($id){
        return view('backend.loans.edit_loan');
    }

    public function view($id){
        return view('backend.loans.details_loan');
    }

    public function delete($id){
        return redirect()->back();
    }
}
