<?php

namespace App\Exports;

use App\Order;
use App\OrderDetail;
use Illuminate\Contracts\View\View;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromView;

class OrderDetailsExport implements FromView
{

    public function view(): View
    {
        return view('dashboard.orders.exportOrderDetails', [
            'orders' => OrderDetail::all()
        ]);
    }
}
