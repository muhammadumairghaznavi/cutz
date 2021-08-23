<?php
namespace App\Exports;

use App\Category;
use App\Customer;
use App\Inbox;
use App\Section;
use App\SubCategory;
use Illuminate\Contracts\View\View;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromView;

class CustomerExport implements FromView
{
    public function view(): View
    {
        return view('dashboard.customers.export', [
            'customers' => Customer::all()
        ]);
    }//customers





}
