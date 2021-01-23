<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class singleOrderResource extends JsonResource
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
            'order_number' => $this->order_number,
            'total' => $this->total,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'address' => $this->Address->first_name,
        ];
//        return parent::toArray($request);
    }
}
