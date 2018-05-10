<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\CallCode;

class CallcodeExport implements FromView
{
    public function view(): View
    {
        return view('exports.callcode', [
            'callcodes' => Callcode::with('taxi')->with('taxicenter')->get()
        ]);
    }
}