<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaxiCenter;
use App\Company;
use Illuminate\Support\Facades\Input;

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
    
    public function add(Request $request)
    {
        TaxiCenter::create(Input::except('_token'));
        return back()->with('success','Taxi Centers Added successfully.');
    }

}
