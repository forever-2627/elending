<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        $notifications = Notification::orderBy('id', 'desc')->get();
        return view('backend.notifications.all_notification', ['notifications' => $notifications]);
    }

    public function view($id){
        $notification = Notification::find($id);
        $notification->read = 1;
        $notification->update();
        $type = $notification->type;
        $content = json_decode($notification->content);

        switch ($type){
            case 1:
                $user = User::find($content->user_id);
                return view('backend.notifications.details_edit_profile', ['content' => $content, 'user' => $user, 'notification_id' => $id]);
            case 2:
                return view('backend.notifications.details_guest_loan_requested', ['content' => $content, 'notification_id' => $id]);
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

    public function delete($id){
        $notification_instance = Notification::find($id);
        try{
            $notification_instance->delete();
        }
        catch (\Exception $e){
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect(route('staff.notifications'))->with($notification);
        }
        $notification = [
            'message' => 'Message Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect(route('staff.notifications'))->with($notification);
    }
}
