<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request){
        $title = $request->title;
        $message = $request->message;
        $user = $request->user();
        $username = $user->given_name . ' ' . $user->surname;
        $email = $user->email;
        $phone_number = $user->phone_number;
        try{
            Message::create([
                'title' => $title,
                'username' => $username,
                'email' => $email,
                'phone_number' => $phone_number,
                'message' => $message,
                'type' => 'user',
                'read' => 0,
                'received_time' => date("Y-m-d H:i:s")
            ]);
        }
        catch (\Exception $e){
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
        $notification = [
            'message' => 'Your message successfully submitted for administrator',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
}
