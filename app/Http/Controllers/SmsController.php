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

        $phoneNumber = '+960'.$phoneNumbers;

        $this->sendMessage($phoneNumber, $message);

        return redirect('sms')->with('alert-success', 'SMS successfully send');
    }

    private function sendMessage($phoneNumber, $message)
    {
        $twilioPhoneNumber = config('services.twilio')['phoneNumber'];
        $messageParams = array(
            'from' => 'Taviyani',
            'body' => $message
        );

        $this->client->messages->create(
            $phoneNumber,
            $messageParams
        );
    }

}
