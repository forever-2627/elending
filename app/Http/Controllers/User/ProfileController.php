<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit_profile(){
        return view('frontend.dashboard.edit_profile');
    }

    public function profile_update_request(Request $request){
        $content = json_encode(
            [
                'user_id'=> $request->user()->id,
                'surname' => $request->surname,
                'given_name' => $request->given_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address' => $request->address
            ]
        );
        Notification::updateOrCreate([
            'title' => 'Profile Edit Requested',
            'type' => 1,
            'content' => $content,
            'received_time' => date("Y-m-d H:i:s"),
            'read' => 0
        ]);
        $notification = [
            'message' => 'Your request is successfully submitted to administrator.',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function change_password(){
        return view('frontend.dashboard.change_password');
    }

    public function password_update_request(Request $request){
        $old_password = $request->old_password;
        $saved_password = $request->user()->password;
        $new_password = $request->new_password;
        if(Hash::check($old_password, $saved_password)){
            $user = $request->user();
            $user->password = Hash::make($new_password);
            $user->update();
            $notification = [
                'message' => 'Password successfully changed!',
                'alert-type' => 'success'
            ];
        }
        else {
            $notification = [
                'message' => 'Your password is not match with our record.',
                'alert-type' => 'error'
            ];
        }
        return redirect()->back()->with($notification);
    }
}
