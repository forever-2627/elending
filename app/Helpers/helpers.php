<?php
/**
 * Created by PhpStorm.
 * User: 585
 * Date: 4/28/2024
 * Time: 12:28 PM
 */

use App\Models\Setting;

if (!function_exists('setting')) {

    function setting()
    {
        $setting = Setting::where(['id' => 1])->first();
        if(!isset($setting)){
            $setting = [
                'interest_rate' => 5,
                'processing_fee' => 3
            ];
        }
        return $setting;
    }
}