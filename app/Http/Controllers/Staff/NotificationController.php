<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        $messages = Message::all();
        return view('backend.notifications.all_notification', ['messages' => $messages]);
    }

    public function view($id){
        $message = Message::find($id);
        $message->read = 1;
        $message->update();
        return view('backend.notifications.details_notification', ['message' => $message]);
    }

    public function check($id){
        $message = Message::find($id);
        $message->read = 1;
        $message->update();
        $notification = [
            'message' => 'This message successfully marked as read.',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
}
