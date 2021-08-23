<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Piece;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\PieceRequest;
use Illuminate\Support\Facades\Storage;

class PieceController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_pieces'])->only('index');
        $this->middleware(['permission:create_pieces'])->only('create');
        $this->middleware(['permission:update_pieces'])->only('edit');
        $this->middleware(['permission:delete_pieces'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $categories = Category::get();
        $pieces = Piece::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.pieces.index', compact('categories', 'pieces'));
    } //end of index
    public function create()
    {
        $categories = Category::get();
        return view('dashboard.pieces.create', compact('categories'));
    } //end of create
    public function store(PieceRequest $request)
    {
        $request_data = $request->all();
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/piece/', 600);
        } //end of if
        $piece = Piece::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.pieces.index');
    } //end of store


    public function show(Piece $piece)
    {
        //
    }
    public function edit(Piece $piece)
    {
        $categories = Category::get();
        return view('dashboard.pieces.edit', compact('categories', 'piece'));
    } //end of edit
    public function update(PieceRequest $request, Piece $piece)
    {
        $request_data = $request->except(['image',]);
        if ($request->image) {
            //check if img not empty remove the current img to replace the new img
            if ($piece->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $piece->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/piece/', 600);
        } //end of external if
        $piece->update($request_data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.pieces.index');
    } //end of update
    public function destroy($piece)
    {
        $item = Piece::find($piece);
        if ($item) {
            if ($item->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/piece/' . $item->image);
            } //end of if
            $item->delete();
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.pieces.index');
        } else {
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.pieces.index');
        }
    } //end of destroy

    public function duplicate($id)
    {
        $item = Piece::find($id);
        if ($item) {
            Piece::create([
                'category_id' =>  $item->category_id,
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
            return redirect()->route('dashboard.pieces.index');
        }
    } //end of duplicate

}
