<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaxiCenter;
use App\CallCode;
use App\Taxi;
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

        $s3 = \Storage::disk(env('UPLOAD_TYPE', 's3'));
        // Image Upload (Taxi front URL)
        $frontImage = $request->taxi_front_url;
        $fileNameFO = 'Taxi/'.$taxi->taxiNo.'/front'.'/original'.'/'.$frontImage->getClientOriginalName();
        $fileNameFT = 'Taxi/'.$taxi->taxiNo.'/front'.'/thumbnail'.'/'.$frontImage->getClientOriginalName();
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
        $taxi->taxi_front_url_o = $fileNameFO;
        $taxi->taxi_front_url_t = $fileNameFT;

        // Image Upload (Taxi back URL)
        $backImage = $request->taxi_back_url;
        $fileNameBO = 'Taxi/'.$taxi->taxiNo.'/back'.'/original'.'/'.$backImage->getClientOriginalName();
        $fileNameBT = 'Taxi/'.$taxi->taxiNo.'/back'.'/thumbnail'.'/'.$backImage->getClientOriginalName();
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
        $taxi->taxi_back_url_o = $fileNameBO;
        $taxi->taxi_back_url_t = $fileNameBT;

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

        return back()->with('alert-success','Taxi Added successfully.');
    }

    public function view($id)
    {
        $taxi = Taxi::findOrFail($id);

        return view('configure.taxi.view', compact('taxi'));
    }
    public function destroy($id)
    {
        $company = Taxi::findOrFail($id);
        $company->delete();
        return redirect()->back()->with('alert-success', 'Successfully deleted the Taxi');
    }
}
