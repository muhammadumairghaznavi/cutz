<?php
namespace App\Http\Controllers\Dashboard;
use App\ProductLocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\productLocationRequest;
use App\Location;
use App\Product;
class ProductLocationController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_productLocations'])->only('index');
        $this->middleware(['permission:create_productLocations'])->only('create');
        $this->middleware(['permission:update_productLocations'])->only('edit');
        $this->middleware(['permission:delete_productLocations'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $productLocations = ProductLocation::where('product_id',$request->product_id)->when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.productLocations.index', compact('productLocations'));
    } //end of index
    public function create(Request $request)
    {
        $products=Product::where('id',$request->product_id)->get();
        $locations= Location::get();
        return view('dashboard.productLocations.create',compact('products', 'locations'));
    } //end of create
    public function updateStockProduct($product_id,$stock)
    {
        $product=Product::where('id',$product_id)->update([
            'stock'=>$stock,
        ]);
    } //end of updateStockProduct
    public function totalStock($product_id)
    {
      return    ProductLocation::where('product_id', $product_id)->sum('stock');
    }//end of updateStockProduct
    public function store(productLocationRequest $request)
    {
        $request_data = $request->all();
        $productLocation = ProductLocation::create($request_data);
        $this->updateStockProduct($productLocation->product_id, $this->totalStock($productLocation->product_id));
        session()->flash('success', __('site.added_successfully'));
        return redirect()->back();
    } //end of store
    public function show(ProductLocation $productLocation)
    {
        //
    }
    public function edit(ProductLocation $productLocation)
    {

        $products = Product::where('id',$productLocation->product_id)->get();
        $locations = Location::get();
        return view('dashboard.productLocations.edit', compact('productLocation', 'products', 'locations'));
    } //end of edit
    public function update(ProductLocationRequest $request, ProductLocation $productLocation)
    {
        $request_data = $request->except(['image',]);
        $productLocation->update($request_data);
        $this->updateStockProduct($productLocation->product_id,$this->totalStock($productLocation->product_id));
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();
    } //end of update
    public function destroy($productLocation)
    {
        $item = ProductLocation::find($productLocation);
        if ($item) {
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
        $item = ProductLocation::find($id);
        if ($item) {
            ProductLocation::create([
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
