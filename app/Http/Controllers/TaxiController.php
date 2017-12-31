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
        $callcodes = Taxi::findOrFail($id);
        $url = url('configure/taxi/update') .'/'. $callcodes->id;

        $form = $formBuilder->create(\App\Forms\Taxi::class, [
            'method' => 'POST',
            'model' => $callcodes,
            'url' => $url
        ]);

        return view('configure.taxi.edit', compact('form'));
    }
    
}
