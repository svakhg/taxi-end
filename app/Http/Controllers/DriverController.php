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
        return view('configure.driver.index', compact('centers', 'callcodes', 'taxis', 'drivers'));
    }

    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(\App\Forms\Driver::class, [
            'method' => 'POST',
            'url' => url('configure/driver/add')
        ]);

        return view('configure.driver.add', compact('form'));
    }

    public function store(Request $request)
    {
        $driver = Driver::create(Input::except('_token', 'li_front_url', 'li_back_url', 'driver_photo_url'));
        $taxi = Taxi::find($driver->taxi_id);
        $taxi->taken = '1';
        $taxi->save();

        // Image Upload (Licence Front)
        $licence_front = $request->li_front_url;
        $licence_front_filename = $licence_front->getClientOriginalName();
        $licence_front_location = 'Taxi/'.$taxi->taxiNo.'/driver'.'/licence'.'/front';
        $licence_front_o = Helper::photo_upload_original_s3($licence_front, $licence_front_filename, $licence_front_location);
        $licence_front_t = Helper::photo_upload_thumbnail_s3($licence_front, $licence_front_filename, $licence_front_location);

        // Image Upload (License back)
        $licence_back = $request->li_back_url;
        $licence_back_filename = $licence_back->getClientOriginalName();
        $licence_back_location = 'Taxi/'.$taxi->taxiNo.'/driver'.'/licence'.'/back';
        $licence_back_o = Helper::photo_upload_original_s3($licence_back, $licence_back_filename, $licence_back_location);
        $licence_back_t = Helper::photo_upload_thumbnail_s3($licence_back, $licence_back_filename, $licence_back_location);

        // Image Upload (Driver Photo)
        $driver_photo = $request->driver_photo_url;
        $driver_photo_filename = $driver_photo->getClientOriginalName();
        $driver_photo_location = 'Taxi/'.$taxi->taxiNo.'/driver'.'/photo';
        $driver_photo_o = Helper::photo_upload_original_s3($driver_photo, $driver_photo_filename, $driver_photo_location);
        $driver_photo_t = Helper::photo_upload_thumbnail_s3($driver_photo, $driver_photo_filename, $driver_photo_location);

        //DB save
        $driver->li_front_url_o = $fileNameFO;
        $driver->li_front_url_t = $fileNameFT;
        $driver->li_back_url_o = $fileNameBO;
        $driver->li_back_url_t = $fileNameBT;
        $driver->driver_photo_url_o = $fileNameDP;
        $driver->driver_photo_url_t = $fileNameDPT;
        $driver->save();



        return back()->with('alert-success','Driver Added successfully.');

    }

    public function edit($id, FormBuilder $formBuilder)
    {
        $driver = Driver::findOrFail($id);
        $url = url('configure/driver/update') .'/'. $driver->id;

        $form = $formBuilder->create(\App\Forms\Driver::class, [
            'method' => 'POST',
            'model' => $driver,
            'url' => $url
        ]);

        return view('configure.driver.edit', compact('form'));
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

        return back()->with('alert-success','Driver Added successfully.');

    }

    public function view($id)
    {
        $driver = Driver::findOrFail($id);

        return view('configure.driver.view', compact('driver'));
    }

    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);

        $taxi = Taxi::find($driver->taxi_id);
        $taxi->taken = '0';
        $taxi->save();

        $driver->delete();
        return redirect()->back()->with('alert-success', 'Successfully deleted the Driver');
    }
}
