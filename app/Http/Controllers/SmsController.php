<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Twilio\Rest\Client;

class SmsController extends Controller
{
    public function __construct(Client $client)
    {
        $this->middleware('auth');
        $this->client = $client;
    }

    public function index()
    {
        return view('sms.index');
    }

    public function send(Request $request)
    {
        $message = $request->input('message');
        $phoneNumbers = $request->input('phoneNumber');
        // $from = $request->input('senderId');
        $from = '+15005550006';
        //dd($from);

        $phoneNumber = '+960'.$phoneNumbers;

        try {
            $this->sendMessage($phoneNumber, $message, $from);
            return redirect('sms')->with('alert-success', 'SMS successfully send');

        } catch ( \Twilio\Exceptions\RestException  $e ) {
            return redirect('sms')->with('alert-danger', $e->getMessage());
        }
    }

    private function sendMessage($phoneNumber, $message, $from)
    {
        $twilioPhoneNumber = config('services.twilio')['phoneNumber'];
        $messageParams = array(
            'from' => $from,
            'body' => $message
        );

        $this->client->messages->create(
            $phoneNumber,
            $messageParams
        );
    }

}
