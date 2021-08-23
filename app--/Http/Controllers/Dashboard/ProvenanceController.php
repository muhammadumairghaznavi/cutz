<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Provenance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\ProvenanceRequest;
use App\ProvenanceCategory;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ProvenanceController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_provenances'])->only('index');
        $this->middleware(['permission:create_provenances'])->only('create');
        $this->middleware(['permission:update_provenances'])->only('edit');
        $this->middleware(['permission:delete_provenances'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $provenances = Provenance::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.provenances.index', compact('provenances'));
    } //end of index
    public function create()
    {
        $categories = Category::get();
        return view('dashboard.provenances.create', compact('categories'));
    } //end of create
    public function store(ProvenanceRequest $request)
    {
        //   dd($request->all());
        $request_data = $request->except(['description_en', 'category_id', 'description_ar']);

        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/provenance/', 48);
        } //end of if
        $provenance = Provenance::create($request_data);

        if ($request->category_id) {
            //   dd('ddd', $request->category_id);
            $this->provenanceCategory($provenance->id, $request->category_id);
        } //end of piece_id

        session()->flash('success', __('site.added_successfully'));
        return redirect()->back();
    } //end of store

    public function provenanceCategory($provenance_id, $category)
    {
        if ($category) {
            $input = Input::all();
            // dd($input);
            foreach ($input['category_id'] as $index => $value) {
                ProvenanceCategory::create(
                    [

                        'description_en' => $input['description_en'][$index],
                        'description_ar' => $input['description_ar'][$index],
                        'category_id' => $input['category_id'][$index],
                        'provenance_id' => $provenance_id,


                    ]
                );
            }
        }
    } //insert images
    public function show(Provenance $provenance)
    {
    }
    public function edit(Provenance $provenance)
    {
        $provenanceCategories = ProvenanceCategory::get();
        $categories = Category::get();
        return view('dashboard.provenances.edit', compact('provenance', 'provenanceCategories', 'categories'));
    } //end of edit
    public function update(ProvenanceRequest $request, Provenance $provenance)
    {
        $request_data = $request->except(['image', 'description_en', 'category_id', 'description_ar']);


        if ($request->image) {
            //check if img not empty remove the current img to replace the new img
            if ($provenance->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $provenance->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/provenance/', 48);
        } //end of external if
        $provenance->update($request_data);


        if ($request->category_id) {
            ProvenanceCategory::where('provenance_id', $provenance->id)->delete();
            $this->provenanceCategory($provenance->id, $request->category_id);
        } //end of piece_id


        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();
    } //end of update
    public function destroy($provenance)
    {
        $item = Provenance::find($provenance);
        if ($item) {
            if ($item->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/provenance/' . $item->image);
            } //end of if
            $item->delete();
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->back();
        } else {
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->back();
        }
    } //end of destroy

    public function duplicate($id)
    {
        $item = Provenance::find($id);
        if ($item) {
            Provenance::create([
                'image' =>  $item->image,
                'ar' => [
                    'title' => $item->title . 'copy' . $item->id,
                    'description'  => $item->description,
                    'short_description' => $item->short_description,
                ],
                'en' => [
                    'title' => $item->title . 'copy' . $item->id,
                    'description'  => $item->description,
                    'short_description' => $item->short_description,
                ],
            ]);/* end of create */
            session()->flash('success', __('site.added_successfully'));
            return redirect()->back();
        }
    } //end of duplicate

}
