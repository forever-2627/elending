<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request){
        $username = $request->name;
        $email = $request->email;
        $phone_number = $request->phone_number;
        $message = $request->message;
        try{
            Message::create([
                'username' => $username,
                'email' => $email,
                'phone_number' => $phone_number,
                'message' => $message,
                'type' => 'guest',
                'read' => 0,
                'received_time' => date("Y-m-d H:i:s")
            ]);
        }
        catch (\Exception $e){
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect(route('staff.loans.create'))->with($notification);
        }
        $notification = [
            'message' => 'Your message successfully submitted for administrator',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
}