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
        return view('configure.callcode', compact('callcodes', 'centers'));
    }

    public function add(Request $request)
    {
        CallCode::create(Input::except('_token'));
        return back()->with('success','Call Code Added successfully.');
    }

    public function view(Request $request)
    {
        //if($request->ajax()){
            $id = $request->id;
            $info = CallCode::find($id);
            $info2 = TaxiCenter::find($info->center_id);
            $info->center = $info2;
            //echo json_decode($info);
            return response()->json($info);
        //}
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $data = CallCode::find($id);
        $response = $data->delete();
        if($response)
            echo "Record Deleted successfully.";
        else
            echo "There was a problem. Please try again later.";
    }
}
