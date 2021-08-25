<?php

namespace App\Http\Resources;

use App\Models\Department;
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
            'standard_id' => $this->standard_id,
            'standard_code' => $this->standard->code,
            'standard_name' => $this->standard->name,
            'photo' => $this->getFirstMediaUrl('photo'),
        ];
        /*return parent::toArray($request);*/
    }
}
