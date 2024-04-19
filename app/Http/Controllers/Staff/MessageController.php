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

    public function delete($id){
        $message = Message::find($id);
        try{
            $message->delete();
        }
        catch (\Exception $e){
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect(route('staff.messages'))->with($notification);
        }
        $notification = [
            'message' => 'Message Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect(route('staff.messages'))->with($notification);
    }
}
