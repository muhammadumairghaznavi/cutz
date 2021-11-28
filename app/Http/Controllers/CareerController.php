<?php

namespace App\Http\Controllers;

use App\Career;
use Illuminate\Http\Request;
// use App\Providers\SweetAlertServiceProvider;
use Redirect;
use SweetAlert;
use Alert;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('frontend career');

        return view('frontend.careers');

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
        $request->validate([
            'fullname' => 'required',
            'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
            'email' => 'required|email',
            'contact' =>'required|numeric'
        ]);
        $career = new Career;
        $career->fullname = $request->fullname;
        $career->email = $request->email;
        $career->contact = $request->contact;
        $career->comments = $request->comments;
        if($request->has('file')){

            $fileName = $request->fullname.time().'.'.$request->file->extension();
            $request->file->move(public_path('file'), $fileName);

            $career->filename = $fileName;
        }
        $career->save();
        alert()->message(__('site.recievedcv'));
        return redirect()->route('home');
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


}
