<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Company;
use Illuminate\Support\Facades\Input;
use Kris\LaravelFormBuilder\FormBuilder;


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

    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(\App\Forms\Company::class, [
            'method' => 'POST',
            'url' => url('configure/company/add')
        ]);

        return view('configure.company.add', compact('form'));
    }

    public function store(Request $request)
    {
        Company::create(Input::except('_token'));
        
        return back()->with('alert-success','Company Added successfully.');
    }

    public function edit($id, FormBuilder $formBuilder)
    {
        $company = Company::findOrFail($id);

        $url = url('configure/company/update') .'/'. $company->id;

        $form = $formBuilder->create(\App\Forms\Company::class, [
            'method' => 'POST',
            'model' => $company,
            'url' => $url
        ]);

        return view('configure.company.edit', compact('form'));
    }

    public function update($id, Request $request)
    {
        $company = Company::findOrFail($id);
        $company->name = $request->name;
        $company->GSTTin = $request->GSTTin;
        $company->RegNo = $request->RegNo;
        $company->address = $request->address;
        $company->island = $request->island;
        $company->city = $request->city;
        $company->telephone = $request->telephone;
        $company->fax = $request->fax;
        $company->mobile = $request->mobile;
        $company->email = $request->email;
        $company->website = $request->website;
        $company->ownername = $request->ownername;
        $company->owneremail = $request->owneremail;
        $company->ownermobile = $request->ownermobile;
        $company->save();
        return back()->with('alert-success','Company Edited successfully.');
    }    

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect()->back()->with('alert-success', 'Successfully deleted the company');
    }

}
