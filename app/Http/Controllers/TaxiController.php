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
        return view('configure.taxi.index', compact('centers', 'callcodes', 'taxis'));
    }

    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(\App\Forms\Taxi::class, [
            'method' => 'POST',
            'url' => url('configure/taxi/add')
        ]);

        return view('configure.taxi.add', compact('form'));
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
        $front_image = $request->taxi_front_url;
        $front_image_filename = $front_image->getClientOriginalName();
        $front_image_location = 'Taxi/'.$taxi->taxiNo.'/front';        
        $front_o = Helper::photo_upload_original_s3($front_image, $front_image_filename, $front_image_location);
        $front_t = Helper::photo_upload_thumbnail_s3($front_image, $front_image_filename, $front_image_location);

        // Image Upload (Taxi back URL)
        $back_image = $request->taxi_back_url;
        $back_image_filename = $back_image->getClientOriginalName();
        $back_image_location = 'Taxi/'.$taxi->taxiNo.'/back';
        $back_o = Helper::photo_upload_original_s3($back_image, $back_image_filename, $back_image_location);
        $back_t = Helper::photo_upload_thumbnail_s3($back_image, $back_image_filename, $back_image_location);
        
        //Save to DB
        $taxi->full_taxi = 'Call Code: '.$callcode->callCode.' - Taxi Number: '.$taxi->taxiNo.' Center Name: '.$taxi->callcode->taxicenter->name;
        $taxi->taxi_front_url_o = $front_o;
        $taxi->taxi_front_url_t = $front_t;
        $taxi->taxi_back_url_o = $back_o;
        $taxi->taxi_back_url_t = $back_t;
        $taxi->save();
        
        return back()->with('alert-success','Taxi Added successfully.');
    }
    
    public function edit($id, FormBuilder $formBuilder)
    {
        $taxi = Taxi::findOrFail($id);
        $url = url('configure/taxi/update') .'/'. $taxi->id;

        $form = $formBuilder->create(\App\Forms\Taxi::class, [
            'method' => 'POST',
            'model' => $taxi,
            'url' => $url
        ]);

        return view('configure.taxi.edit', compact('form'));
    }

    public function update($id, Request $request)
    {
        $taxi = Taxi::findOrFail($id);
        $callcode_old = CallCode::find($taxi->callcode_id);
        $callcode_old->taken = '0';
        $callcode_old->save();
        
        $taxi->callcode_id = $request->callcode_id;
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
        $taxi->center_name = $request->center_name;
        $taxi->save();

        $callcode = CallCode::find($taxi->callcode_id);
        $callcode->taken = '1';
        $callcode->save();

        $taxi->full_taxi = 'Call Code: '.$callcode->callCode.' - Taxi Number: '.$taxi->taxiNo.' Center Name: '.$taxi->callcode->taxicenter->name;
        $taxi->save();

        return back()->with('alert-success','Taxi Updated successfully.');
    }

    public function view($id)
    {
        $taxi = Taxi::findOrFail($id);

        return view('configure.taxi.view', compact('taxi'));
    }
    
    public function destroy($id)
    {
        $taxi = Taxi::findOrFail($id);
        $result = Driver::where('taxi_id', $id)->get();

        if (!$result->count()) {
            $callcode = CallCode::find($taxi->callcode_id);
            $callcode->taken = '0';
            $callcode->save();

            Helper::delete_image_s3($taxi->taxi_front_url_o);
            Helper::delete_image_s3($taxi->taxi_front_url_t);
            Helper::delete_image_s3($taxi->taxi_back_url_o);
            Helper::delete_image_s3($taxi->taxi_back_url_t);

            $taxi->delete();
            return redirect()->back()->with('alert-success', 'Successfully deleted the Taxi');
        }
        else {
            return redirect()->back()->with('alert-danger', 'Driver(s) has been added under this taxi');
        }
    }

    public function photo($id)
    {
        $taxi = Taxi::findOrFail($id);

        return view('configure.taxi.photo', compact('taxi'));
    }
}
