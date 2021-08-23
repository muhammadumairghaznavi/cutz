<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\QuotationsExport;
use App\Quote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class QuoteController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_quotes'])->only('index');
        $this->middleware(['permission:create_quotes'])->only('create');
        $this->middleware(['permission:update_quotes'])->only('edit');
        $this->middleware(['permission:delete_quotes'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $quotes = Quote::when($request->search, function ($q) use ($request) {
            return $q->Where('email', 'like', '%' . $request->search . '%');
        })->when($request->status, function ($q2) use ($request) {
            return $q2->Where('status',  $request->status);
        })->latest()->get();
        return view('dashboard.quotes.index', compact('quotes'));
    } //end of index
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show(Quote $quote)
    {
        //
    }
    public function edit(Quote $quote)
    {
        if ($quote->status == 'notactive') {
            Quote::where('id', $quote->id)->update([
                'status' => 'active'
            ]);
        } else {
            Quote::where('id', $quote->id)->update([
                'status' => 'notactive'
            ]);
        }
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();
    }
    public function update(Request $request, Quote $quote)
    {
        //
    }
    public function destroy(Quote $quote)
    {
        if ($quote) {
            $quote->delete();
        }
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->back();
    }
    public function export_quotations()
    {
        $nam = 'Quotations-Data' . date("yy:m:d:h:i:s") . '.xlsx';
        return Excel::download(new QuotationsExport,     $nam);
    }
}
