<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'city' => $this->city,
            'street' => $this->street,
            'building_number' => $this->building_number,
            'apartment_number' => $this->apartment_number,
            'phone' => $this->phone,
            'type' => $this->type,
            'descriotion' => $this->descriotion,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
