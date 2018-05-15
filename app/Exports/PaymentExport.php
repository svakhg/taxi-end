<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\paymentHistory;

class PaymentExport implements FromView
{
    public function view(): View
    {
        return view('exports.payment', [
            'payments' => paymentHistory::all()
        ]);
    }
}