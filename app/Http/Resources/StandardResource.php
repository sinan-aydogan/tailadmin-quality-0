<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StandardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name'=> $this->name,
            'code'=> $this->code,
            'standard_type'=> $this->standard_type,
            'scope'=> $this->scope,
            'status'=> $this->status,
            'departments'=> $this->departments,
            'products'=> $this->products,
            'rawMaterials'=> $this->rawMaterials,
            'machines'=> $this->machines,
            'measurementTools'=> $this->measurementTools
        ];
    }
}
