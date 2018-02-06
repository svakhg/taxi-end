<?php

namespace App\Http\Controllers;

use App\Contact;
use App\GroupSms;
use App\GroupSmsStatus;
use Illuminate\Http\Request;

class GroupSmsController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();   
        return view('sms.group.index', compact('contacts'));
    }

    public function store(Request $request)
    {
        $senderId = $request->senderId;
        $contact = Contact::find($request->contact_id);
        $message = $request->message;
        $numbers = $contact->numbers->pluck('number')->toArray();

        // dd($contact, $numbers);

        $groupSms = new GroupSms;
        $groupSms->senderId = $senderId;
        $groupSms->message = $message;
        $groupSms->save();

        foreach ($numbers as $number) {
            $status = new GroupSmsStatus;
            $status->groupsms_id = $groupSms->id;
            $status->phone_number = $number;
            $status->save();
        }

        $url = "sms/group/status/".$groupSms->id;

        return redirect($url);
    }

    public function status($id)
    {
        $groupSms = GroupSms::with('numbers')->where('id', $id)->first();
        return view('sms.group.status', compact('groupSms'));
    }
}
