<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
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
            'email' => $this->email,
            'name' => $this->name,
            'offcial_name' => $this->offcial_name,
            'phone' => $this->phone,
            'address' => $this->address,
            'Legal_papers' => $this->Legal_papers,
            'is_active' => $this->is_active,
            'available' => $this->available,
            'holding' => $this->holding,
            'total' => $this->total,
            'owner_name' => $this->owner_name,
            'bank_name' => $this->bank_name,
            'branch_name' => $this->branch_name,
            'account_id' => $this->account_id,
            'iban' => $this->iban,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
