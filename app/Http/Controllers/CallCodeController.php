<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\CallCode;
use App\TaxiCenter;
use Illuminate\Support\Facades\Input;

class CallCodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $callcodes = CallCode::all();
        $centers = TaxiCenter::all();
        return view('configure.callcode.index', compact('callcodes', 'centers'));
    }

    public function add(Request $request)
    {
        CallCode::create(Input::except('_token'));
        return back()->with('success','Call Code Added successfully.');
    }

    
}
