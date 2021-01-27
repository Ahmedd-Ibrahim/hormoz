<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $product =  Product::where('id',$this->product_id)
            ->select('id','name','regular_price','sku','sale_percent')->first();
        $product['count'] = $this->count;
        $product['total'] = $this->count * $product->regular_price;
        if (isset($product->sale_percent)) {
            $product['sale_percent'] =  $product->sale_percent;
            $precent = $product->sale_percent * $product->regular_price / 100;

            $product['price_after_sale'] = $product->regular_price - $precent;
            $product['total_after_sale'] = $product['price_after_sale'] * $this->count;

        }
        return $product;
    }
}
