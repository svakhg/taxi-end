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

class TaxiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $centers = TaxiCenter::all();
        $callcodes = CallCode::where('taken', '0')->orderBy('callCode')->get();
        $taxis = Taxi::all();
        
        $callcodes_change = \App\CallCode::all();
        foreach ($callcodes_change as $callcode) {
            $callcode->full_callcode = $callcode->callCode . ' - ' . $callcode->taxicenter->name;
            $callcode->save();
        }
        
        return view('configure.taxi.index', compact('centers', 'callcodes', 'taxis'));
    }

    public function create(FormBuilder $formBuilder)
    {
        $callcodes = \App\CallCode::where('taken', '0')->get();
        return view('configure.taxi.new.add', compact('callcodes'));
    }

    public function store(Request $request)
    {
        $taxi = Taxi::create(Input::except('_token', 'taxi_front_url', 'taxi_back_url'));
        
        $taxiCenter = Taxi::find($taxi->id);
        $taxiCenter->center_name = $taxi->callcode->taxicenter->cCode;
        $taxiCenter->save();

        $callcode = CallCode::find($taxi->callcode_id);
        $callcode->taken = '1';
        $callcode->save();

        // Image Upload (Taxi front URL)
        if($request->has('taxi_front_url')) {
            $front_image = $request->taxi_front_url;
            $front_image_filename = $front_image->getClientOriginalName();
            $front_image_location = 'Taxi/'.$taxi->taxiNo.'/front';        
            $front_o = Helper::photo_upload_original_s3($front_image, $front_image_filename, $front_image_location);
            $front_t = Helper::photo_upload_thumbnail_s3($front_image, $front_image_filename, $front_image_location);
            $taxi->taxi_front_url_o = $front_o;
            $taxi->taxi_front_url_t = $front_t;
        } else {
            $taxi->taxi_front_url_o = "Taxi/default/photo.jpg";
            $taxi->taxi_front_url_t = "Taxi/default/photo.jpg";
        }

        // Image Upload (Taxi back URL)
        if($request->has('taxi_back_url')) {
            $back_image = $request->taxi_back_url;
            $back_image_filename = $back_image->getClientOriginalName();
            $back_image_location = 'Taxi/'.$taxi->taxiNo.'/back';
            $back_o = Helper::photo_upload_original_s3($back_image, $back_image_filename, $back_image_location);
            $back_t = Helper::photo_upload_thumbnail_s3($back_image, $back_image_filename, $back_image_location);
            $taxi->taxi_back_url_o = $back_o;
            $taxi->taxi_back_url_t = $back_t;
        } else {
            $taxi->taxi_back_url_o = "Taxi/default/photo.jpg";
            $taxi->taxi_back_url_t = "Taxi/default/photo.jpg";
        }
        
        //Save to DB
        $taxi->full_taxi = 'Call Code: '.$callcode->callCode.' - Taxi Number: '.$taxi->taxiNo.' Center Name: '.$taxi->callcode->taxicenter->name;
        $taxi->callcode = $callcode->callCode;
        $taxi->save();
        
        return back()->with('alert-success','Taxi Added successfully.');
    }
    
    public function edit($id)
    {
        $taxi = Taxi::findOrFail($id);
        $callcodes = \App\CallCode::where('taken', '0')->get();
        return view('configure.taxi.new.edit', compact('taxi', 'callcodes'));
    }

    public function update($id, Request $request)
    {
        $taxi = Taxi::findOrFail($id);
        
        $old_callcode_id = $taxi->callcode_id;
        $new_callcode_id = $request->callcode_id;

        // dd($old_callcode_id, $new_callcode_id);

        // $taxi->callcode_id = $request->callcode_id;
        $taxi->taxiNo = $request->taxiNo;
        $taxi->taxiChasisNo = $request->taxiChasisNo;
        $taxi->taxiEngineNo = $request->taxiEngineNo;
        $taxi->taxiBrand = $request->taxiBrand;
        $taxi->taxiModel = $request->taxiModel;
        $taxi->taxiColor = $request->taxiColor;
        $taxi->taxiOwnerName = $request->taxiOwnerName;
        $taxi->taxiOwnerMobile = $request->taxiOwnerMobile;
        $taxi->taxiOwnerEmail = $request->taxiOwnerEmail;
        $taxi->taxiOwnerAddress = $request->taxiOwnerAddress;
        $taxi->registeredDate = $request->registeredDate;
        $taxi->anualFeeExpiry = $request->anualFeeExpiry;
        $taxi->roadWorthinessExpiry = $request->roadWorthinessExpiry;
        $taxi->insuranceExpiry = $request->insuranceExpiry;
        $taxi->rate = $request->rate;
        // $taxi->center_name = $request->center_name;

        if ($old_callcode_id !== $new_callcode_id) {
            $old_callcode = CallCode::find($old_callcode_id);
            $old_callcode->taken = '0';
            $old_callcode->save();

            $taxi->callcode_id = $new_callcode_id;

            $new_callcode = CallCode::find($new_callcode_id);
            $new_callcode->taken = '1';
            $new_callcode->save();
        } else {
            $taxi->callcode_id = $old_callcode_id;
        }
        // $taxi->full_taxi = 'Call Code: '.$taxi->callcode->callCode.' - Taxi Number: '.$taxi->taxiNo.' Center Name: '.$taxi->callcode->taxicenter->name;
        $taxi->callcode = $callcode->callCode;
        $taxi->save();
        
        return redirect('configure/taxi')->with('alert-success','Taxi Updated successfully.');
    }

    public function view($id)
    {
        $taxi = Taxi::findOrFail($id);

        return view('configure.taxi.view', compact('taxi'));
    }
    
    public function destroy($id)
    {
        //
    }

    public function photo($id)
    {
        $taxi = Taxi::findOrFail($id);

        return view('configure.taxi.photo', compact('taxi'));
    }

    public function deactivate($id)
    {
        $taxi = Taxi::findOrFail($id);
        $old_callcode = CallCode::find($taxi->callcode_id);
        $old_callcode->taken = '0';
        $old_callcode->save();

        $taxi->active = '0';
        $taxi->callcode_id = '301';
        $taxi->callcode = '0';
        $taxi->save();

        return redirect('configure/taxi')->with('alert-success', 'Taxi deactivated successfully.');
    }

    public function activate($id)
    {
        $taxi = Taxi::findOrFail($id);
        $new_callcode = CallCode::where('taken', 0)->first();
        
        $taxi->callcode_id = $new_callcode->id;
        $taxi->active = '1';
        $taxi->callcode = $new_callcode->callCode;
        $taxi->save();
         
        return redirect('configure/taxi')->with('alert-success', 'Taxi activated successfully.');
    }
}
