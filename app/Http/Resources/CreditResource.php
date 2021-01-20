<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CreditResource extends JsonResource
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
            'user_id' => $this->user_id,
            'name' => $this->name,
            'number' => $this->number,
            'expire_date' => $this->expire_date,
            'cvv' => $this->cvv,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
