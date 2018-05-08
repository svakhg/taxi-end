<?php

namespace App\Http\Controllers;

use App\DrivingS;
use App\Instructors;
use Illuminate\Http\Request;

use Twilio\Rest\Client;

class DrivingSController extends Controller
{
    public function __construct(Client $client)
    {
        $this->middleware('auth');
        $this->client = $client;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = DrivingS::orderBy('created_at', 'desc')->get();
        return view('drivingschool.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $instructors = Instructors::all();
        return view('drivingschool.add', compact('instructors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $student = DrivingS::create([
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
            'theorydate' => request('theorydate'),
            'user_id' => auth()->id(),
        ]);
        
        $message = "Welcome ". $student->name .", to Taviyani Driving School. You will be receving further updatest through sms";
        $phoneNumbers = $student->phone;
        $from = "TDS";

        //dd($from);

        $phoneNumber = '+960'.$phoneNumbers;

        try {
            $this->sendMessage($phoneNumber, $message, $from);
            return redirect('driving-school')->with('alert-success', 'Successfully Registered a new Student');

        } catch ( \Twilio\Exceptions\RestException  $e ) {
            return redirect('driving-school')->with('alert-danger', 'Driver added but '.$e->getMessage());
        }

        
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
        $instructors = Instructors::all();
        return view('drivingschool.edit', compact('student', 'instructors'));
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
        $drivingS->c_address = $request->c_address;
        $drivingS->p_address = $request->p_address;
        $drivingS->instructor = $request->instructor;
        $drivingS->rate = $request->rate;
        $drivingS->finisheddate = $request->finisheddate;
        $drivingS->theorydate = $request->theorydate;
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
        $drivingS->delete();
        return redirect('/driving-school')->with('alert-success','Successfully deleted the Student');
    }

    private function sendMessage($phoneNumber, $message, $from)
    {
        $twilioPhoneNumber = config('services.twilio')['phoneNumber'];
        $messageParams = array(
            'from' => $from,
            'body' => $message
        );

        $this->client->messages->create(
            $phoneNumber,
            $messageParams
        );
    }
}
