<?php

namespace App\Http\Controllers\Dashboard;

use App\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TicketDetail;

class TicketController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_tickets'])->only('index');
        $this->middleware(['permission:create_tickets'])->only('create');
        $this->middleware(['permission:update_tickets'])->only('edit');
        $this->middleware(['permission:delete_tickets'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $tickets = Ticket::when($request->section, function ($q) use ($request) {
            return $q->Where('section',  $request->section);
        })->when($request->type, function ($q) use ($request) {
            return $q->Where('type',  $request->type);
        })->latest()->get();

        return view('dashboard.tickets.index', compact('tickets'));
    } //end of index
    public function reply(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'ticket_id' => 'required',
        ]);

        TicketDetail::create([
            'message' => $request->message,
            'ticket_id' => $request->ticket_id,
            'admin_id' => auth()->user()->id,


        ]);



        return redirect()->back();
    }
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show(Ticket $ticket)
    {
        //
    }


    public function edit(Ticket $ticket)
    {
        $tickets = TicketDetail::where('ticket_id', $ticket->id)->get();
        return view('dashboard.tickets.edit', compact('ticket', 'tickets'));
    }


    public function update(Request $request, Ticket $ticket)
    {
        
         $request_data = $request->except(['image',]);
        $ticket->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {

        if ($ticket) {
            $ticket->delete();
        }
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->back();
    }
    public function export_quotations()
    {
        dd('export_quotations');
    }
}
