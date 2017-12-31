<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Twilio\Rest\Client;

class SmsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->client = $client;
    }

    public function index()
    {
        return view('sms.index');
    }

    public function send()
    {
        $message = $request->input('message');
    }
}
