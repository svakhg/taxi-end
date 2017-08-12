<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaxiCenter;
use App\CallCode;
use App\Taxi;
use App\Driver;
use Illuminate\Support\Facades\Input;

class DriverController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $centers = TaxiCenter::all();
        $callcodes = CallCode::all();
        $taxis = Taxi::all();
        $drivers = Driver::all();
        return view('configure.driver', compact('centers', 'callcodes', 'taxis', 'drivers'));
    }

    public function add(Request $request)
    {
        $driver = Driver::create(Input::except('_token', 'photoUrl'), ['photoUrl' => 'test']);
        
        $path = $request->file('photoUrl')->store('driverPhotos');

        $driverPhoto = Driver::find($driver->id);
        $driverPhoto->photoUrl = $path;
        $driverPhoto->save();

        return back()->with('success','Driver Added successfully.');

    }

    public function view(Request $request)
    {
        //if($request->ajax()){            
            $id = $request->id;
            $info = Driver::find($id);
            $info2 = Taxi::find($info->taxi_id);
            $info->taxi = $info2;
            //echo json_decode($info);
            return response()->json($info);
        //}        
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $data = Driver::find($id);
        $response = $data->delete();
        if($response)
            echo "Record Deleted successfully.";
        else
            echo "There was a problem. Please try again later.";
    }
}
