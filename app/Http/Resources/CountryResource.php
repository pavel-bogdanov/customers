<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            'id'              => $this->id,
            'iso_2'           => $this->iso_2,
            'iso_3'           => $this->iso_3,
            'name'            => $this->name,
            'capital'         => $this->capital,
            'area'            => $this->area,
            'flag'            => $this->flag,
            'currency_code'   => $this->currency_code,
            'currency_symbol' => $this->currency_symbol
        ];
    }
}
