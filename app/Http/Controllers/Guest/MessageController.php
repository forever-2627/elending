<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MessageController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'g-recaptcha-response' => ['required', function(string $attribute, mixed $value, \Closure $fail){
                $g_response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => config('services.recaptcha.secret_key'),
                    'response' => $value,
                    'remoteip' => \request()->ip()
                ]);
                if(!$g_response->json('success')){
                    $fail("The {$attribute} is invalid.");
                }
            }]
        ]);
        $title = $request->title;
        $username = $request->name;
        $email = $request->email;
        $phone_number = $request->phone_number;
        $message = $request->message;
        try{
            Message::create([
                'title' => $title,
                'username' => $username,
                'email' => $email,
                'phone_number' => $phone_number,
                'message' => $message,
                'type' => 'guest',
                'read' => 0,
                'received_time' => date("Y-m-d H:i:s")
            ]);
        }
        catch (\Exception $e){
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
        $notification = [
            'message' => 'Your message successfully submitted for administrator',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
}