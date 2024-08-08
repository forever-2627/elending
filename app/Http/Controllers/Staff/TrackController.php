<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function index(Request $request){
        $loans =  Loan::where(['state' => 1])->orderBy('created_at', 'desc')->get();
        $user_id = $request->user_id;
        $loan_frequency = $request->loan_frequency;
        if($user_id || $loan_frequency){
            $filtered_loans_by_user = filter_by_user($loans, $user_id, 'loan');
            $filtered_loans_by_frequency = filter_by_frequency($filtered_loans_by_user, $loan_frequency);
            $processed_loans = track_loans($filtered_loans_by_frequency);
            return view('backend.track.all', [
                'loans' => $processed_loans,
                'user_id' => $user_id,
                'loan_frequency' => $loan_frequency
            ]);
        }
        else{
            $filtered_loans = auth()->user()->role_id != config('constants.roles.admin_role_id') ? filter_by_date($loans) : $loans;
            $processed_loans = track_loans($filtered_loans);
            return view('backend.track.all', [
                'loans' => $processed_loans,
                'user_id' => $user_id,
                'loan_frequency' => $loan_frequency
            ]);
        }

    }
}
