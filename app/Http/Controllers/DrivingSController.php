<?php

namespace App\Http\Controllers;

use App\DrivingS;
use Illuminate\Http\Request;

class DrivingSController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = DrivingS::all();
        return view('drivingschool.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('drivingschool.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DrivingS::create([
            'name' => request('name'),
            'id_card' => request('id_card'),
            'phone' => request('phone'),
            'category' => request('category'),
            'c_address' => request('c_address'),
            'p_address' => request('p_address'),
            'instructor' => request('instructor'),
            'rate' => request('rate'),
            'remarks' => request('remarks'),
            'finisheddate' => request('finisheddate'),
            'user_id' => auth()->id(),
        ]);
        
        return redirect('driving-school')->with('alert-success', 'Successfully Registered a new Student');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DrivingS  $drivingS
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = DrivingS::findOrFail($id);
        return view('receipt.drivingschool',compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DrivingS  $drivingS
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = DrivingS::findorfail($id);
        return view('drivingschool.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DrivingS  $drivingS
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DrivingS $drivingS)
    {
        $drivingS->name = $request->name;
        $drivingS->id_card = $request->id_card;
        $drivingS->phone = $request->phone;
        $drivingS->category = $request->category;
        $drivingS->c_address = $request->c_address;
        $drivingS->p_address = $request->p_address;
        $drivingS->instructor = $request->instructor;
        $drivingS->rate = $request->rate;
        $drivingS->remarks = $request->remarks;
        $drivingS->finisheddate = $request->finisheddate;
        $drivingS->save();
        return redirect('/driving-school')->with('alert-success','Successfully edited the Student');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DrivingS  $drivingS
     * @return \Illuminate\Http\Response
     */
    public function destroy(DrivingS $drivingS)
    {
        //
    }
}
