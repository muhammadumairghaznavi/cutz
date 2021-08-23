<?php

namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class InvoicesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{

    public function collection()
    {
        return Invoice::select('customer_id', 'invoice_number', 'invoice_date', 'due_date', 'package_id', 'service_id', 'product_id', 'total', 'discount', 'payment_method', 'payment_status', 'fees', 'vat', 'note', 'status')->get();
    }
    public function headings(): array
    {
        return [
            'customer_id', 'invoice_number', 'invoice_date', 'due_date', 'package_id', 'service_id', 'product_id', 'total', 'discount', 'payment_method', 'payment_status', 'fees', 'vat', 'note', 'status'

        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
