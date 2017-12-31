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
        $taxis = Taxi::where('taken', '0')->get();
        $drivers = Driver::all();
        return view('configure.driver.index', compact('centers', 'callcodes', 'taxis', 'drivers'));
    }

    public function add(Request $request)
    {
        $driver = Driver::create(Input::except('_token', 'photoUrl'), ['photoUrl' => 'test']);
        
        if ($request->file('photoUrl')){
            $path = $request->file('photoUrl')->store('driverPhotos');

            $driverPhoto = Driver::find($driver->id);
            $driverPhoto->photoUrl = $path;
            $driverPhoto->save();
        }
        $taxi = Taxi::find($driver->taxi_id);
        $taxi->taken = '1';
        $taxi->save();

        return back()->with('success','Driver Added successfully.');

    }

    
    // public function ajax($id)
    // {
    //     $driver = Driver::find($id);
    //     return view('configure.driverAjax', compact('driver'));
    // }
}
