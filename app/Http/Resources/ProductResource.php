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
            'name' => $this->name,
            'code' => $this->code,
            'department_name' => $this->department->name,
            'department_id' => $this->department_id,
            'productType' => $this->productType->name,
            'is_certified' => $this->is_certified,
            'standards' => $this->standards,
            'photo' => $this->getFirstMediaUrl('photo'),
        ];
    }
}
