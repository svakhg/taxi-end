<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaxiCenter;
use App\Company;
use Illuminate\Support\Facades\Input;
use Kris\LaravelFormBuilder\FormBuilder;

class TaxicenterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $centers = TaxiCenter::all();
        $companies = Company::all();
        return view('configure.center.index', compact('centers', 'companies'));
    }

    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(\App\Forms\TaxiCenter::class, [
            'method' => 'POST',
            'url' => url('configure/taxi-center/add')
        ]);

        return view('configure.center.add', compact('form'));
    }
    
    public function store(Request $request)
    {
        TaxiCenter::create(Input::except('_token'));
        return back()->with('success','Taxi Centers Added successfully.');
    }

    public function edit($id, FormBuilder $formBuilder)
    {
        $center = TaxiCenter::findOrFail($id);

        $form = $formBuilder->create(\App\Forms\TaxiCenter::class, [
            'method' => 'POST',
            'model' => $center,
            'url' => url('configure/taxi-center/update')
        ]);

        return view('configure.center.add', compact('form'));
    }

}
