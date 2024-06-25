<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\LoanRequestedEmail;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Mail\CreateUserMail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function create_user(Request $request, $notification_id){
        $content = json_decode(Notification::find($notification_id)->content);
        $encrypted_email = Crypt::encrypt($content->email);
        LoanRequestedEmail::updateOrCreate([
            'email' => $content->email,
            'loan_amount' => $content->loan_amount
        ]);
        $link = route('user.request.loan', $encrypted_email);
        $details = [
            'title' => 'Thank You for Your Enquiry',
            'link' => $link
        ];
        try {
            Mail::to($content->email)->send(new CreateUserMail($details));
            $notification = [
                'message' => 'Email sent successfully for client.',
                'alert-type' => 'success'
            ];
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Failed to send email. ' . $e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }
}
