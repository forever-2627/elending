<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(){
        $messages = Message::all();
        return view('backend.messages.all_message', ['messages' => $messages]);
    }

    public function view($id){
        $message = Message::find($id);
        $message->read = 1;
        $message->update();
        return view('backend.messages.details_message', ['message' => $message]);
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
