<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DisplayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function jrIndex()
    {
        return view('display.jr');
    }

    public function cityIndex()
    {
        return view('display.city');
    }
}
