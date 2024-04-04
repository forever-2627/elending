<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->user = new User();
    }

    public function index(){
        $users = User::all();
        return view('backend.users.all_user', ['users' => $users]);
    }

    public function create(){
        return view('backend.users.add_user');
    }

    public function store(Request $request){
        $username = $request->username;
        $email = $request->email;
        $phone_number = $request->phone_number;
        $address = $request->address;
        $password = $request->password;
        try{
            User::create([
                'name' => $username,
                'email' => $email,
                'phone_number' => $phone_number,
                'address' => $address,
                'password' => Hash::make($password)
            ]);
        }
        catch (\Exception $e){
            $notification = [
              'message' => $e->getMessage(),
              'alert-type' => 'error'
            ];
            return redirect(route('staff.users.create'))->with($notification);
        }
        $notification = [
            'message' => 'User Added Successfully',
            'alert-type' => 'success'
        ];
        return redirect(route('staff.users'))->with($notification);
    }

    public function edit($user_id){
        $user = User::find($user_id);
        return view('backend.users.edit_user', ['user' => $user]);
    }

    public function update(Request $request){
        $user_id = $request->user_id;
        $username = $request->username;
        $email = $request->email;
        $phone_number = $request->phone_number;
        $address = $request->address;
        $password = $request->password;
        try{
            User::updateOrCreate(['id' => $user_id],[
                'name' => $username,
                'email' => $email,
                'phone_number' => $phone_number,
                'address' => $address,
                'password' => Hash::make($password)
            ]);
        }
        catch (\Exception $e){
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect(route('staff.users.edit', $user_id))->with($notification);
        }
        $notification = [
            'message' => 'User Information Updated Successfully',
            'alert-type' => 'success'
        ];
        return redirect(route('staff.users'))->with($notification);
    }

    public function delete($user_id){
        $user = User::find($user_id);
        try{
            $user->delete();
        }
        catch (\Exception $e){
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect(route('staff.users'))->with($notification);
        }
        $notification = [
            'message' => 'User Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect(route('staff.users'))->with($notification);
    }
}
