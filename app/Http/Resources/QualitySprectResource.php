<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QualitySprectResource extends JsonResource
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
            'name' => $this->name,
            'spect_type' => $this->spect_type,
            'unit' => $this->unit,
            'department_id' => $this->department_id,
            'department_name' => $this->department->name,
            'standard_id' => $this->standard_id,
            'standard_name' => $this->standard->name,
        ];
    }
}
