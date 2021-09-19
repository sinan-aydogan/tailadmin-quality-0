<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RawMaterialResource extends JsonResource
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
            'model' => $this->model,
            'manufacturer' => $this->manufacturer,
            'raw_material_type_name' => $this->rawMaterialType->name,
            'raw_material_type_id' => $this->raw_material_type_id,
            'suppliers' => $this->suppliers,
            'properties' => $this->properties,
            'standards' => $this->standards,
            'files' => $this->getMedia('file')
        ];
    }
}
