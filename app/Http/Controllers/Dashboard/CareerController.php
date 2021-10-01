<?php

namespace App\Http\Controllers\Dashboard;

use App\Career;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CareerController extends Controller
{

    public function __construct(){
        $this->middleware(['permission:read_careers'])->only('index');
        $this->middleware(['permission:create_careers'])->only('create');
        $this->middleware(['permission:update_careers'])->only('edit');
        $this->middleware(['permission:delete_careers'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $career = Career::all();
        return view('dashboard.careers.index', compact('career'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
     * @param  \App\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function show(Career $career)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function edit(Career $career)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Career $career)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function destroy(Career $career)
    {
        //
    }
    public function downloadcv($id){

        $cv = Career::where('id', $id)->firstOrFail();
        $pathToFile = public_path('file/' . $cv->filename);
        return response()->download($pathToFile);

    }
}
