<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductTypeResource extends JsonResource
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
            'name'=>$this->name,
            'department_id'=>$this->department_id,
            'department_name'=>$this->department->name,
            'description'=>$this->description,
        ];
        /*return parent::toArray($request);*/
    }
}
