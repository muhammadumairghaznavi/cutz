<?php

namespace App\Exports;

use App\Order;
use Illuminate\Contracts\View\View;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromView;

class OrderExport implements FromView
{

    public function view(): View
    {
        return view('dashboard.orders.export', [
            'orders' => Order::all()
        ]);
    }
}
