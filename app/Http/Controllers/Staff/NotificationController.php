<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        return view('backend.notifications.all_notification');
    }

    public function view($id){
        return view('backend.notifications.details_notification');
    }

    public function check($id){
        return redirect()->back();
    }
}
