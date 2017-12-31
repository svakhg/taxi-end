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
        return back()->with('alert-success','Call Code Added successfully.');
    }
    public function edit($id, FormBuilder $formBuilder)
    {
        $callcodes = CallCode::findOrFail($id);
        $url = url('configure/call-code/update') .'/'. $callcodes->id;

        $form = $formBuilder->create(\App\Forms\CallCode::class, [
            'method' => 'POST',
            'model' => $callcodes,
            'url' => $url
        ]);

        return view('configure.callcode.edit', compact('form'));
    }

    public function update($id, Request $request)
    {
        $callcodes = CallCode::findOrFail($id);
        $callcodes->center_id = $request->center_id;
        $callcodes->callCode = $request->callCode;
        $callcodes->save();
        return back()->with('alert-success','Call Code Edited successfully.');
    }
    public function destroy($id)
    {
        $company = CallCode::findOrFail($id);
        $company->delete();
        return redirect()->back()->with('alert-success', 'Successfully deleted the Call Code');
    }
}
