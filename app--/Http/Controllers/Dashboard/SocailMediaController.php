<?php

namespace App\Http\Controllers\Dashboard;

use App\SocailMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocailMediaController extends Controller
{
    
    public function index()
    {
        $socails=SocailMedia::latest()->paginate(20);
      

        return view('dashboard.socails.index', compact('socails'));
    } //end of index
        
    public function create()
    {
        return abort(404); //redirct to page not found
    }

    
    public function store(Request $request)
    {
        return abort(404); //redirct to page not found
    }

   
    public function show(SocailMedia $SocailMedia)
    {
        return abort(404); //redirct to page not found
    }

  

    
    public function edit( $socails)
    {
        $socails=SocailMedia::find($socails);
      
        
        return view('dashboard.socails.edit', compact('socails'));
    }

    
    public function update(Request $request,$socails)
    {
        $socails=SocailMedia::find($socails);
     
        $socails->update($request->all());
      
        
        session()->flash('success', __('site.edited_successfuly'));
        return redirect()->route('dashboard.socail.index');
    }
    
    public function destroy(SocailMedia $socailMedia)
    {
        return abort(404); //redirct to page not found
        //
    }
}
