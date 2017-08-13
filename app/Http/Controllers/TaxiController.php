<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaxiCenter;
use App\CallCode;
use App\Taxi;
use Illuminate\Support\Facades\Input;

class TaxiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $centers = TaxiCenter::all();
        $callcodes = CallCode::where('taken', '0')->orderBy('callCode')->get();
        $taxis = Taxi::all();
        return view('configure.taxi', compact('centers', 'callcodes', 'taxis'));
    }

    public function add(Request $request)
    {
        $taxi = Taxi::create(Input::except('_token'));
        
        $taxiCenter = Taxi::find($taxi->id);
        $taxiCenter->center_name = $taxi->callcode->taxicenter->cCode;
        $taxiCenter->save();

        $callcode = CallCode::find($taxi->callcode_id);
        $callcode->taken = '1';
        $callcode->save();

        return back()->with('success','Taxi Added successfully.');
    }

    public function view(Request $request)
    {
        //if($request->ajax()){            
            $id = $request->id;
            $info = Taxi::find($id);
            $info2 = CallCode::find($info->callcode_id);
            $info3 = TaxiCenter::find($info2->center_id);
            $info->callcode = $info2;
            $info->texicenter = $info3;
            //echo json_decode($info);
            return response()->json($info);
        //}        
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $data = Taxi::find($id);
        $response = $data->delete();
        if($response)
            echo "Record Deleted successfully.";
        else
            echo "There was a problem. Please try again later.";
    }
}
