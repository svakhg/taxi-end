<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\CallCode;
use App\TaxiCenter;
use Illuminate\Support\Facades\Input;
use Kris\LaravelFormBuilder\FormBuilder;

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

    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(\App\Forms\CallCode::class, [
            'method' => 'POST',
            'url' => url('configure/call-code/add')
        ]);

        return view('configure.callcode.add', compact('form'));
    }

    public function store(Request $request)
    {
        CallCode::create(Input::except('_token'));
        return back()->with('success','Call Code Added successfully.');
    }

    
}
