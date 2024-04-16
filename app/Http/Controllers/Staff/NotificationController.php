<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        $notifications = Notification::all();
        return view('backend.notifications.all_notification', ['notifications' => $notifications]);
    }

    public function view($id){
        $notification = Notification::find($id);
        $notification->read = 1;
        $notification->update();
        $type = $notification->type;
        $content = json_decode($notification->content);
        $user = User::find($content->user_id);
        switch ($type){
            case 1:
                return view('backend.notifications.details_edit_profile', ['content' => $content, 'user' => $user, 'notification_id' => $id]);
        }
        return redirect()->back();
    }

    public function approve_update_profile($id){
        $notification = Notification::find($id);
        $content = json_decode($notification->content);
        $user = User::find($content->user_id);
        $user->surname = $content->surname;
        $user->given_name = $content->given_name;
        $user->email = $content->email;
        $user->phone_number = $content->phone_number;
        $user->address = $content->address;
        $user->update();
        $message = [
            'message' => 'Profile successfully updated!',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($message);
    }

    public function check($id){
        $notification = Notification::find($id);
        $notification->read = 1;
        $notification->update();
        $notification = [
            'message' => 'This message successfully marked as read.',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
}
