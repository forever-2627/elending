<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit_profile(){
        return view('frontend.dashboard.edit_profile');
    }

    public function change_password(){
        return view('frontend.dashboard.change_password');
    }
}
