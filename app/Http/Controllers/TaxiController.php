<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaxiCenter;
use App\CallCode;
use App\Taxi;
use Illuminate\Support\Facades\Input;
use Kris\LaravelFormBuilder\FormBuilder;

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

        return back()->with('success','Taxi Added successfully.');
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

        return back()->with('success','Taxi Added successfully.');
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
