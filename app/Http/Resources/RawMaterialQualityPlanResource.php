<?php

namespace App\Http\Resources;

use App\Models\QualitySpect;
use App\Models\Spect;
use Illuminate\Http\Resources\Json\JsonResource;

class RawMaterialQualityPlanResource extends JsonResource
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
            'code' => $this->code,
            'department_id' => $this->department_id,
            'department_name' => $this->department->name,
            'raw_material_id' => $this->raw_material_id,
            'raw_material_name' => $this->rawMaterial->name,
            'raw_material_spects' => $this->spects,
        ];
        /* return parent::toArray($request); */
    }
}
