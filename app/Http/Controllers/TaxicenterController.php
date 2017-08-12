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
        return view('configure.center', compact('centers', 'companies'));
    }
    
    public function add(Request $request)
    {
        TaxiCenter::create(Input::except('_token'));
        return back()->with('success','Taxi Centers Added successfully.');
    }

    public function view(Request $request)
    {
        //if($request->ajax()){
            $id = $request->id;
            $info = TaxiCenter::find($id);
            $info2 = Company::find($info->company_id);
            $info->company = $info2;
            //echo json_decode($info);
            return response()->json($info);
        //}
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $data = TaxiCenter::find($id);
        $response = $data->delete();
        if($response)
            echo "Record Deleted successfully.";
        else
            echo "There was a problem. Please try again later.";
    }
}
