<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\paymentHistory;
use App\Taxi;
use App\Driver;
use App\CallCode;
use App\TaxiCenter;
use Illuminate\Support\Facades\Auth;

use Twilio\Rest\Client;

class PaymentHistoryController extends Controller
{
    public function __construct(Client $client)
    {
        $this->middleware('auth');
        $this->client = $client;
    }

    public function index()
    {
        $payments = paymentHistory::all();
        return view('payment.index', compact('payments'));
    }

    public function view(Request $request)
    {
        //if($request->ajax()){
            $id = $request->id;
            $info = paymentHistory::find($id);
            $info2 = Taxi::find($info->taxi_id);
            $info3 = Driver::find($info2->driver->taxi_id);
            $info3 = CallCode::find($info2->callcode_id);
            $info->center = TaxiCenter::find($info3->center_id);
            $info->taxi = $info2;
            $info->driver = $info3;
            $info->callcode = $info3;
            //echo json_decode($info);
            return response()->json($info);
        //}
    }

    public function add(Request $request)
    {
        $payment = paymentHistory::find($request->idPayment);
        $payment->qty = '1';
        $payment->total = $request->total;
        $payment->subtotal = $request->subtotal;
        $payment->totalAmount = $request->total + $request->subtotal;
        $payment->user_id = Auth::user()->id;
        $payment->paymentStatus = '1';
        $payment->save();

        // Check if all payments are made OR make the taxi state 0 
        $checkP = paymentHistory::where('taxi_id', $payment->taxi_id)->where('paymentStatus', '0')->get();
        if ($checkP->count() >= 1) {
            $taxi = Taxi::find($payment->taxi_id);
            $taxi->state = '0';
            $taxi->save();    
        } else {
            $taxi = Taxi::find($payment->taxi_id);
            $taxi->state = '1';
            $taxi->save(); 
        }

        //Send SMS
        $phone_number_owner = '+9607774713';
        $message = $request->smsText;

        //$this->sendMessage($phone_number_owner, $message);

        if ($request->send_sms = "1") {
            $phoneNumber = '+960'.$request->driverNumber;
            $this->sendMessage($phoneNumber, $message);
        }

        return back()->with('success','Payment Recived Successfully.');

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
