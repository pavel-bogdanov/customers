<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CountryResource;

class CustomerResource extends JsonResource
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
            'id'           => $this->id,
            'email'        => $this->email,
            'name'         => $this->name,
            'country'      => new CountryResource($this->whenLoaded('country')),
            'city'         => $this->city,
            'state'        => $this->state,
            'zip'          => $this->zip,
            'address'      => $this->address,
            'phone'        => $this->phone,
            'company_name' => $this->company_name,
        ];
    }
}
