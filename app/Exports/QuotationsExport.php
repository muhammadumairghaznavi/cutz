<?php

namespace App\Exports;

use App\Quote;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class QuotationsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{

    public function collection()
    {
        return Quote::select('name', 'phone', 'email', 'company', 'specialization', 'budget', 'message', 'status', 'created_at', 'updated_at', 'deleted_at')->get();
    }
    public function headings(): array
    {
        return [

            'name', 'phone', 'email', 'company', 'specialization', 'budget', 'message', 'status', 'created_at', 'updated_at', 'deleted_at'
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
