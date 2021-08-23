<?php

namespace App\Http\Controllers\Dashboard;

use App\Instruction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\InstructionRequest;
use App\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class InstructionController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_instructions'])->only('index');
        $this->middleware(['permission:create_instructions'])->only('create');
        $this->middleware(['permission:update_instructions'])->only('edit');
        $this->middleware(['permission:delete_instructions'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $products = Product::get();
        $instructions = Instruction::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->when($request->product_id, function ($q) use ($request) {
            return $q->where('product_id', $request->product_id);
        })->latest()->get();
        return view('dashboard.instructions.index', compact('products', 'instructions'));
    } //end of index
    public function create()
    {
        $products = Product::get();
        return view('dashboard.instructions.create', compact('products'));
    } //end of create
    public function store(InstructionRequest $request)
    {
        $request_data = $request->except(['image',]);
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/instructions/', 600);
        } //end of if


        Instruction::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.instructions.index');
    } //end of store
    public function show(Instruction $instruction)
    {
        //
    }
    public function edit(Instruction $instruction)
    {
        $products = Product::get();
        return view('dashboard.instructions.edit', compact('products', 'instruction'));
    } //end of edit
    public function update(InstructionRequest $request, Instruction $instruction)
    {
        $request_data = $request->except(['image',]);
        if ($request->image) {
            if ($instruction->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $instruction->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/instructions/', 600);
        } //end of external if
        $instruction->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.instructions.index');
    } //end of update
    public function destroy(Instruction $instruction)
    {
        $instruction->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.instructions.index');
    } //end of destroy
    public function duplicate($id)
    {
        $item = Instruction::find($id);
        if ($item) {
            Instruction::create([
                'product_id' =>  $item->product_id,
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
