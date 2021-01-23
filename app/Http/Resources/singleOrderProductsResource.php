<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class singleOrderProductsResource extends JsonResource
{
    /**
     * @var mixed
     */


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'name' => $this->name,
            'sku' => $this->sku,
            'price' => $this->pivot->price,
        ];
        return parent::toArray($request);
    }
}
