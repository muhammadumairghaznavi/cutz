<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\SubscriberExport;
use App\Subscribe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class SubscribeController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_subscribe'])->only('index');
        $this->middleware(['permission:create_subscribe'])->only('create');
        $this->middleware(['permission:update_subscribe'])->only('edit');
        $this->middleware(['permission:delete_subscribe'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $subscribes = Subscribe::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('email', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.subscribes.index', compact('subscribes'));
    } //end of subscribes

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function show(Subscribe $subscribe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscribe $subscribe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscribe $subscribe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */

    public function destroy($subscribe)
    {
        $subscribe = Subscribe::find($subscribe);
        $subscribe->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.subscribe.index');
    } //end of destroy


    public function export_subscribe()
    {

        return Excel::download(new SubscriberExport, 'SubscriberExport.xlsx');
    }
}
