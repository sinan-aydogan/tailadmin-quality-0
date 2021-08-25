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
            'department' => $this->department->name,
            'department_id' => $this->department_id,
            'productType' => $this->productType->name,
            'is_certified' => $this->is_certified,
            'is_certified' => $this->is_certified,
            'standard_id' => $this->standard_id,
            'standard' => $this->standard->code,
            'photo' => $this->getFirstMediaUrl('photo'),
        ];
        /*return parent::toArray($request);*/
    }
}
