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
        return back()->with('alert-success','Taxi Centers Added successfully.');
    }

    public function edit($id, FormBuilder $formBuilder)
    {
        $center = TaxiCenter::findOrFail($id);
        $url = url('configure/taxi-center/update') .'/'. $center->id;

        $form = $formBuilder->create(\App\Forms\TaxiCenter::class, [
            'method' => 'POST',
            'model' => $center,
            'url' => $url
        ]);

        return view('configure.center.edit', compact('form'));
    }

    public function update($id, Request $request)
    {
        $center = TaxiCenter::findOrFail($id);
        $center->company_id = $request->company_id;
        $center->name = $request->name;
        $center->cCode = $request->cCode;
        $center->address = $request->address;
        $center->telephone = $request->telephone;
        $center->mobile = $request->mobile;
        $center->email = $request->email;
        $center->fax = $request->fax;
        $center->save();
        return back()->with('alert-success','Company Edited successfully.');
    }
    public function destroy($id)
    {
        $company = TaxiCenter::findOrFail($id);
        $company->delete();
        return redirect()->back()->with('alert-success', 'Successfully deleted the Taxi Center');
    }
}
