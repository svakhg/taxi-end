<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\paymentHistory;

class PaymentHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $payments = paymentHistory::all();
        return view('payment.index', compact('payments'));
    }
}
