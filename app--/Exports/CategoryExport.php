<?php

namespace App\Exports;

use App\Category;
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

class CategoryExport implements FromView
{
    // public function view(): View
    // {
    //     return view('dashboard.sections.exports', [
    //         'sections' => Section::all()
    //     ]);
    // }//setion

    public function view(): View
    {
        return view('dashboard.categories.export', [
            'categories' => Category::all()
        ]);
    } //categories

    // public function view(): View
    // {
    //     return view('dashboard.categories.export', [
    //         'subCategories' => SubCategory::all()
    //     ]);
    // }//subCategories





}
