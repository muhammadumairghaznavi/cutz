<?php

namespace App\Exports;

use App\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductExport implements FromView
{
  public function view(): View
  {
    return view('dashboard.products.exports', [
      'products' => Product::latest()->get()
    ]);
  }
}
