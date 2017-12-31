<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaxiCenter;
use App\CallCode;
use App\Taxi;
use App\Driver;
use Illuminate\Support\Facades\Input;
use Kris\LaravelFormBuilder\FormBuilder;

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
        $driver = Driver::create(Input::except('_token'));
        
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
