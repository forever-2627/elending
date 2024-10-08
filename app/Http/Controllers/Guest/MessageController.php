<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Notification;
use Exception;
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

        try{
            $title = $this->do_validation($request->title, 'Title');
            $username = $this->do_validation($request->name, 'Username');
            $email = $this->do_validation($request->email, 'Email');
            $phone_number = $this->do_validation($request->phone_number, 'Phone Number');
            $message = $this->do_validation($request->message, 'Message');
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

    public function loan_requested(Request $request){
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

        try{
            $email = $this->do_validation($request->loan_email, 'Email');
            $loan_amount = $this->do_validation($request->loan_amount, 'Loan Amount');
            $content = json_encode(
                [
                    'email' => $email,
                    'loan_amount' => $loan_amount,
                ]
            );
            Notification::updateOrCreate([
                'title' => 'New Loan Requested',
                'type' => 2,
                'content' => $content,
                'received_time' => date("Y-m-d H:i:s"),
                'read' => 0
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
            'message' => 'Your request successfully submitted for administrator',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    private function do_validation($data, $label){
        if($data == null){
            throw new Exception( $label . ' is required');
        }
        else return $data;
    }

}