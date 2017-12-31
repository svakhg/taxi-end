<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaxiCenter;
use App\CallCode;
use App\Taxi;
use App\Driver;
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

        $s3 = \Storage::disk(env('UPLOAD_TYPE', 's3'));
        // Image Upload (Lisence Front)
        $frontImage = $request->li_front_url;
        $fileNameFO = 'Taxi/'.$taxi->taxiNo.'/driver'.'/original'.'/'.$frontImage->getClientOriginalName();
        $fileNameFT = 'Taxi/'.$taxi->taxiNo.'/driver'.'/thumbnail'.'/'.$frontImage->getClientOriginalName();
        $original_F = Image::make($frontImage)->resize(1080, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $thumbnail_F = Image::make($frontImage)->resize(null, 200, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $s3->put($fileNameFO, $original_F->stream()->__toString(), 'public');
        $s3->put($fileNameFT, $thumbnail_F->stream()->__toString(), 'public');
        
        $driver->li_front_url_o = $fileNameFO;
        $driver->li_front_url_t = $fileNameFT;

        // Image Upload (License back)
        $backImage = $request->li_back_url;
        $fileNameBO = 'Taxi/'.$taxi->taxiNo.'/driver'.'/original'.'/'.$backImage->getClientOriginalName();
        $fileNameBT = 'Taxi/'.$taxi->taxiNo.'/driver'.'/thumbnail'.'/'.$backImage->getClientOriginalName();
        $original_B = Image::make($backImage)->resize(1080, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $thumbnail_B = Image::make($backImage)->resize(null, 200, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $s3->put($fileNameBO, $original_B->stream()->__toString(), 'public');
        $s3->put($fileNameBT, $thumbnail_B->stream()->__toString(), 'public');
        
        $driver->li_back_url_o = $fileNameBO;
        $driver->li_back_url_t = $fileNameBT;

        // Image Upload (Driver Photo)
        $driverPhoto = $request->driver_photo_url;
        $fileNameDP = 'Taxi/'.$taxi->taxiNo.'/driver'.'/original'.'/'.$driverPhoto->getClientOriginalName();
        $fileNameDPT = 'Taxi/'.$taxi->taxiNo.'/driver'.'/thumbnail'.'/'.$driverPhoto->getClientOriginalName();
        $original_DP = Image::make($driverPhoto)->resize(1080, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $thumbnail_DP = Image::make($driverPhoto)->resize(null, 200, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $s3->put($fileNameDP, $original_DP->stream()->__toString(), 'public');
        $s3->put($fileNameDPT, $thumbnail_DP->stream()->__toString(), 'public');
        
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
        $company = Driver::findOrFail($id);
        $company->delete();
        return redirect()->back()->with('alert-success', 'Successfully deleted the Driver');
    }
}
