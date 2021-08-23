<?php

namespace App\Http\Controllers\Dashboard;

use App\City;
use App\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\StateRequest;
use Illuminate\Support\Facades\Storage;

class StateController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_states'])->only('index');
        $this->middleware(['permission:create_states'])->only('create');
        $this->middleware(['permission:update_states'])->only('edit');
        $this->middleware(['permission:delete_states'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $states = State::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.states.index', compact('states'));
    } //end of index
    public function create()
    {
        $cites = City::get();
        return view('dashboard.states.create', compact('cites'));
    } //end of create
    public function store(StateRequest $request)
    {
        $request_data = $request->all();
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/state/', 600);
        } //end of if
        $state = State::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.states.index');
    } //end of store


    public function show(State $state)
    {
        //
    }
    public function edit(State $state)
    {
        $cites = City::get();

        return view('dashboard.states.edit', compact('state', 'cites'));
    } //end of edit
    public function update(StateRequest $request, State $state)
    {
        $request_data = $request->except(['image',]);
        if ($request->image) {
            //check if img not empty remove the current img to replace the new img
            if ($state->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $state->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/state/', 600);
        } //end of external if
        $state->update($request_data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.states.index');
    } //end of update
    public function destroy($state)
    {
        $item = State::find($state);
        if ($item) {
            if ($item->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/state/' . $item->image);
            } //end of if
            $item->delete();
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.states.index');
        } else {
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.states.index');
        }
    } //end of destroy

    public function duplicate($id)
    {
        $item = State::find($id);
        if ($item) {
            State::create([
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
            return redirect()->route('dashboard.states.index');
        }
    } //end of duplicate

}
