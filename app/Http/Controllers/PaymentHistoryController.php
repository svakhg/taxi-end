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
        if ($request->send_sms = "1") {
            $payment = paymentHistory::find($request->idPayment);
            $payment->qty = '1';
            $payment->total = $request->total;
            $payment->subtotal = $request->subtotal;
            $payment->totalAmount = $request->total + $request->subtotal;
            $payment->user_id = Auth::user()->id;
            $payment->paymentStatus = '1';
            $payment->save();

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

            $phoneNumbers = $request->driverNumber;
            $phoneNumber = '+960'.$phoneNumbers;
            $message = $request->smsText;

            $this->sendMessage($phoneNumber, $message);

            return back()->with('success','Payment Recived Successfully.');
        } elseif ($request->send_sms = "0") {
            $payment = paymentHistory::find($request->idPayment);
            $payment->qty = '1';
            $payment->total = $request->total;
            $payment->subtotal = $request->subtotal;
            $payment->totalAmount = $request->total + $request->subtotal;
            $payment->user_id = Auth::user()->id;
            $payment->paymentStatus = '1';
            $payment->save();
            
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

            return back()->with('success','Payment Recived Successfully.');
        } else {
            return;
        }
        
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
