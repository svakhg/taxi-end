<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Helpers\Twilio;

class SmsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('sms.index');
    }

    public function send(Request $request)
    {
        new Twilio;
        
        $message = $request->input('message');
        $phoneNumbers = $request->input('phoneNumber');
        // $from = $request->input('senderId');

        $from = '+15005550006';

        $phoneNumber = '+960'.$phoneNumbers;

        $sendSMS = Twilio::sendSms($phoneNumber, $message, $from);

        if ($sendSMS == true) {
            return redirect('sms')->with('alert-success', 'SMS successfully send');
        } else {
            return redirect('sms')->with('alert-danger', $sendSMS->getMessage());
        }

    }

}
