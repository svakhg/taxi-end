<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\paymentHistory;
use App\Taxi;
use App\Driver;
use App\CallCode;
use App\TaxiCenter;

class PaymentHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
            echo "SMS is being send";
            print_r($request->all());
            return;
        } elseif ($request->send_sms = "0") {
            echo "SMS is not being send";
            print_r($request->all());
            return;
        } else {
            return;
        }
        
    }
}
