<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Company;
use Illuminate\Support\Facades\Input;

class CompanyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $companies = Company::all();
        return view('configure.company.index', compact('companies'));
    }

    public function add(Request $request)
    {
        Company::create(Input::except('_token'));
        return back()->with('success','Company Added successfully.');
    }

}
