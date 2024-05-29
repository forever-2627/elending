<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        $setting = Setting::where(['id' => 1])->first();
        if(!isset($setting)){
            $setting = [
                'interest_rate' => 5,
                'processing_fee' => 3,
                'staff_viewable_days' => 3
            ];
        }
        return view('admin.settings', ['setting' => (object) $setting]);
    }

    public function store(Request $request){
        $interest_rate = $request->interest_rate;
        $processing_fee = $request->processing_fee;
        $staff_viewable_days = $request->staff_viewable_days;
        $setting = Setting::where(['id' => 1])->first();
        try{
            if($setting){
                $setting->interest_rate = $interest_rate;
                $setting->processing_fee = $processing_fee;
                $setting->staff_viewable_days = $staff_viewable_days;
                $setting->update();
                $notification = array(
                    'message' => 'Setting Updated Successfully!',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }else{
                Setting::updateOrCreate([
                    'id' => 1,
                    'interest_rate' => $interest_rate,
                    'processing_fee' => $processing_fee,
                    'staff_viewable_days' => $staff_viewable_days
                ]);
                $notification = array(
                    'message' => 'Setting Saved Successfully!',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }
        }
        catch (\Exception $e){
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
