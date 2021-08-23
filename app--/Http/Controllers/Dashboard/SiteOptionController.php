<?php

namespace App\Http\Controllers\Dashboard;

use App\SiteOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
class SiteOptionController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_options'])->only('index');
        $this->middleware(['permission:create_options'])->only('create');
        $this->middleware(['permission:update_options'])->only('edit');
        $this->middleware(['permission:delete_options'])->only('destroy');

    }//end of constructor
   
    public function index()
    {
        $site_options=SiteOption::latest()->paginate(20);
    
        
        return view('dashboard.site_options.index', compact('site_options'));
    } //end of index
        
    public function create()
    {
        return abort(404); //redirct to page not found
    }

    
    public function store(Request $request)
    {
        return abort(404); //redirct to page not found
    }

   
    public function show(SiteOption $SiteOption)
    {
        return abort(404); //redirct to page not found
    }

  

    
    public function edit( $site_options )
    {
        $site_options =SiteOption::find($site_options );
      
        
        return view('dashboard.site_options.edit', compact('site_options'));
    }

    
    public function update(Request $request,$site_options)
    {
        $site_options=SiteOption::find($site_options);
        $request->validate([
          
            
            'logo' => 'image:mimes:jpeg,bmp,png|max:2048',
            'icon' => 'image:mimes:jpeg,bmp,png|max:2048',

        ]);
        $request_data = $request->except(['logo','icon']);
//logo  icon
        if ($request->logo) {
            //check if logo not empty remove the current logo to replace the new logo
            if ($site_options->logo != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $site_options->logo);
            } //end of inner if
            Image::make($request->logo)
                ->resize(630, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/' . $request->logo->hashName()));
            $request_data['logo'] = $request->logo->hashName();
        } //end of external if
       

        if ($request->icon) {
            //check if imicong not empty remove the current icon to replace the new icon
            if ($site_options->icon != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $site_options->icon);
            } //end of inner if
            Image::make($request->icon)
                ->resize(630, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/' . $request->icon->hashName()));
            $request_data['icon'] = $request->icon->hashName();
        } //end of external if
       




        $site_options->update($request_data);

        
        session()->flash('success', __('site.edited_successfuly'));
        return redirect()->route('dashboard.site_options.index');
    }
    
    public function destroy(SiteOption $socailMedia)
    {
        return abort(404); //redirct to page not found
        //
    }
}
