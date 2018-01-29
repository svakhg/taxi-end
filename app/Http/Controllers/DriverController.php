<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaxiCenter;
use App\CallCode;
use App\Taxi;
use App\Driver;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Input;

use Kris\LaravelFormBuilder\FormBuilder;

use Illuminate\Contracts\Filesystem\Filesystem;
use Image;

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

        $taxis_change = \App\Taxi::all();
        foreach ($taxis_change as $taxi) {
            $taxi->full_taxi = 'Call Code: '.$taxi->callcode->callCode.' - Taxi Number: '.$taxi->taxiNo.' Center Name: '.$taxi->callcode->taxicenter->name;
            $taxi->save();
        }

        return view('configure.driver.index', compact('centers', 'callcodes', 'taxis', 'drivers'));
    }

    public function create()
    {
        $taxis = Taxi::where('active', '1')->get();
        return view('configure.driver.new.add', compact('taxis'));
    }

    public function store(Request $request)
    {
        $driver = Driver::create(Input::except('_token', 'li_front_url', 'li_back_url', 'driver_photo_url'));

        // Image Upload (Licence Front)
        if($request->has('li_front_url')) {
            $licence_front = $request->li_front_url;
            $licence_front_filename = $licence_front->getClientOriginalName();
            $licence_front_location = 'Taxi/'.$taxi->taxiNo.'/driver'.'/licence'.'/front';
            $licence_front_o = Helper::photo_upload_original_s3($licence_front, $licence_front_filename, $licence_front_location);
            $licence_front_t = Helper::photo_upload_thumbnail_s3($licence_front, $licence_front_filename, $licence_front_location);
            $driver->li_front_url_o = $licence_front_o;
            $driver->li_front_url_t = $licence_front_t;
        } else {
            $driver->li_front_url_o = 'Taxi/default/pc-front.png';
            $driver->li_front_url_t = 'Taxi/default/pc-front.png';
        }

        // Image Upload (License back)
        if($request->has('li_back_url')) {
            $licence_back = $request->li_back_url;
            $licence_back_filename = $licence_back->getClientOriginalName();
            $licence_back_location = 'Taxi/'.$taxi->taxiNo.'/driver'.'/licence'.'/back';
            $licence_back_o = Helper::photo_upload_original_s3($licence_back, $licence_back_filename, $licence_back_location);
            $licence_back_t = Helper::photo_upload_thumbnail_s3($licence_back, $licence_back_filename, $licence_back_location);
            $driver->li_back_url_o = $licence_back_o;
            $driver->li_back_url_t = $licence_back_t;
        } else {
            $driver->li_back_url_o = 'Taxi/default/pc-front.png';
            $driver->li_back_url_t = 'Taxi/default/pc-front.png';
        }

        // Image Upload (Driver Photo)
        if($request->has('driver_photo_url')) {
            $driver_photo = $request->driver_photo_url;
            $driver_photo_filename = $driver_photo->getClientOriginalName();
            $driver_photo_location = 'Taxi/'.$taxi->taxiNo.'/driver'.'/photo';
            $driver_photo_o = Helper::photo_upload_original_s3($driver_photo, $driver_photo_filename, $driver_photo_location);
            $driver_photo_t = Helper::photo_upload_thumbnail_s3($driver_photo, $driver_photo_filename, $driver_photo_location);
            $driver->driver_photo_url_o = $driver_photo_o;
            $driver->driver_photo_url_t = $driver_photo_t;
        } else {
            $driver->driver_photo_url_o = 'Taxi/default/Taxi-Driver-PNG-File.png';
            $driver->driver_photo_url_t = 'Taxi/default/Taxi-Driver-PNG-File.png';
        }

        $driver->active = '1';
        $driver->save();

        return redirect()->back()->with('alert-success', 'Driver Added successfully.');

    }

    public function edit($id)
    {
        $driver = Driver::findOrFail($id);
        $taxis = Taxi::where('active', '1')->get();
        return view('configure.driver.new.edit', compact('driver', 'taxis'));
    }
    
    public function update($id, Request $request)
    {
        $driver = Driver::findOrFail($id);
        
        $driver->taxi_id = $request->taxi_id;
        $driver->driverName = $request->driverName;
        $driver->driverIdNo = $request->driverIdNo;
        $driver->driverTempAdd = $request->driverTempAdd;
        $driver->driverPermAdd = $request->driverPermAdd;
        $driver->driverMobile = $request->driverMobile;
        $driver->driverEmail = $request->driverEmail;
        $driver->driverLicenceNo = $request->driverLicenceNo;
        $driver->driverLicenceExp = $request->driverLicenceExp;
        $driver->driverPermitNo = $request->driverPermitNo;
        $driver->driverPermitExp = $request->driverPermitExp;
        $driver->save();

        return redirect('configure/driver')->with('alert-success','Driver edited successfully.');

    }

    public function view($id)
    {
        $driver = Driver::findOrFail($id);

        return view('configure.driver.view', compact('driver'));
    }

    public function destroy($id)
    {
        // $driver = Driver::findOrFail($id);

        // $taxi = Taxi::find($driver->taxi_id);
        // $taxi->taken = '0';
        // $taxi->save();

        // Helper::delete_image_s3($driver->li_front_url_o);
        // Helper::delete_image_s3($driver->li_front_url_t);
        // Helper::delete_image_s3($driver->li_back_url_o);
        // Helper::delete_image_s3($driver->li_back_url_t);
        // Helper::delete_image_s3($driver->driver_photo_url_o);
        // Helper::delete_image_s3($driver->driver_photo_url_t);
        
        // $driver->delete();
        // return redirect()->back()->with('alert-success', 'Successfully deleted the Driver');
    }

    public function photo($id)
    {
        $driver = Driver::findOrFail($id);

        return view('configure.driver.photo', compact('driver'));
    }

    public function deactivate($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->active = '0';
        $driver->save();

        return redirect()->back()->with('alert-success', 'Successfully deactivated the Driver');
    }

    public function activate($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->active = '1';
        $driver->save();

        return redirect()->back()->with('alert-success', 'Successfully activated the Driver');
    }
}
