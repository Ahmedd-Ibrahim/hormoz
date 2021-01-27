<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\Types\Parent_;

class FavoriteResource extends JsonResource
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
            'name' => $this->name,
            'sku' => $this->sku,
            'regular_price'=> $this->regular_price,
            'sale' => $this->sale_percent,
        ];
        return parent::toArray($request);
//        return [
//            'id' => $this->id,
//            'user_id' => $this->user_id,
//            'product_id' => $this->product_id,
//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at
//        ];

    }
}
