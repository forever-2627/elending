<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->user = new User();
    }

    public function index(Request $request){
        if($request->user()->role_id == config('constants.roles.admin_role_id')){
            $users = User::orderBy('id', 'desc')->get();
        }
        else{
            $users = User::where(['role_id' => config('constants.roles.user_role_id')] )->orderBy('id', 'desc')->get();
        }
        return view('backend.users.all_user', ['users' => $users]);
    }

    public function create(){
        return view('backend.users.add_user');
    }

    public function store(Request $request){
        $surname = $request->surname;
        $given_name = $request->given_name;
        $email = $request->email;
        $phone_number = $request->phone_number;
        $address = $request->address;
        $role_id = $request->user()->role_id == config('constants.roles.admin_role_id') ? $request->role_id : 1;
        $password = $request->password;
        try{
            User::create([
                'surname' => $surname,
                'given_name'=>$given_name,
                'email' => $email,
                'phone_number' => $phone_number,
                'address' => $address,
                'role_id' => $role_id * 1,
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
        $user = User::find($user_id);
        $surname = $request->surname;
        $given_name = $request->given_name;
        $email = $request->email;
        $phone_number = $request->phone_number;
        $address = $request->address;
        $role_id = $request->user()->role_id == config('constants.roles.admin_role_id') ? $request->role_id : 1;
        $password = $request->password;
        try{
            $user->update([
                'surname' => $surname,
                'given_name'=>$given_name,
                'email' => $email,
                'phone_number' => $phone_number,
                'address' => $address,
                'role_id' => $role_id * 1,
                'password' => $password == '' ? $user->password : Hash::make($password)
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
