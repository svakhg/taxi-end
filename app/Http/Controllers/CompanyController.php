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
        return view('configure.company', compact('companies'));
    }

    public function add(Request $request)
    {
        Company::create(Input::except('_token'));
        return back()->with('success','Company Added successfully.');
    }

    public function view(Request $request)
    {
        //if($request->ajax()){
            $id = $request->id;
            $info = Company::find($id);
            //echo json_decode($info);
            return response()->json($info);
        //}
    }

    public function delete(Request $request)
    {
        $id = $request -> id;
        $data = Company::find($id);
        $response = $data ->delete();
        if($response)
            echo "Record Deleted successfully.";
        else
            echo "There was a problem. Please try again later.";
    }
}
