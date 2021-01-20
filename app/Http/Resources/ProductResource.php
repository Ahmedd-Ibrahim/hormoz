<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'vendor_id' => $this->vendor_id,
            'name' => $this->name,
            'category_id' => $this->category_id,
            'maxmim_stock_for_client' => $this->maxmim_stock_for_client,
            'weight' => $this->weight,
            'sku' => $this->sku,
            'description' => $this->description,
            'stock' => $this->stock,
            'regluar_price' => $this->regluar_price,
            'is_sale' => $this->is_sale,
            'sale_precent' => $this->sale_precent,
            'sale_expire_date' => $this->sale_expire_date,
            'catching_word' => $this->catching_word,
            'code' => $this->code,
            'status' => $this->status,
            'brand' => $this->brand,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
