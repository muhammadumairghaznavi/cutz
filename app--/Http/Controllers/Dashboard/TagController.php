<?php

namespace App\Http\Controllers\Dashboard;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\PlanRequest;
use App\Http\Requests\backend\TagRequest;

class TagController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_tags'])->only('index');
        $this->middleware(['permission:create_tags'])->only('create');
        $this->middleware(['permission:update_tags'])->only('edit');
        $this->middleware(['permission:delete_tags'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $tags = Tag::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.tags.index', compact('tags'));
    } //end of plans
    public function create()
    {
        return view('dashboard.tags.create');
    } //end of create
    public function store(TagRequest $request)
    {
        $request_data = $request->except(['',]);
        Tag::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->back();
    } //end of store

    public function show(Tag $tag)
    {
        //
    }

    public function edit(Tag $tag)
    {
        return view('dashboard.tags.edit', compact('tag'));
    }

    public function update(TagRequest $request, Tag $tag)
    {
        $request_data = $request->except(['image',]);

        $tag->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.tags.index');
    } //end of update


    public function destroy(Tag $tag)
    {
        $tag->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.tags.index');
    }
}
