<?php
namespace App\Http\Resources;
use App\Cart;
use App\CartDetail;
use App\Product;
use App\ProductWeight;
use Illuminate\Http\Resources\Json\JsonResource;
class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $productWeight = ProductWeight::find($this->productWeight_id);
        return
            [
                'cart_item_id' => $this->id,
                // 'cart_item_id' => $productWeight->weight->title ?? "",
                'qty' => $this->qty,
                'type' => $this->type,
                //  'product_price' => $this->product->price,
                'total_price_items' => $this->TotalCart,
                'total_price_additions' => $this->SumCartDetails,
                'product' => new ProductResource(Product::where('id', $this->product_id)->first()),
                'product_addtions' => CartDetailsResource::collection($this->cart_detials),
            ];
    }
}
