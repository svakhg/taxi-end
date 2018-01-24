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
        return view('drivingschool.index');
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
        $this->validate(request(), [
            'name' => 'required',
            'category' => 'required',
            'remarks' => 'required'
        ]);

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
    public function show(DrivingS $drivingS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DrivingS  $drivingS
     * @return \Illuminate\Http\Response
     */
    public function edit(DrivingS $drivingS)
    {
        //
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
        //
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
