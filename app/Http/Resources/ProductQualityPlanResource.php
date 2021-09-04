<?php

namespace App\Http\Resources;

use App\Models\QualitySpect;
use App\Models\Spect;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductQualityPlanResource extends JsonResource
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
            'product_id' => $this->product_id,
            'product_name' => $this->product->name,
            'product_spects' => $this->product_spects,
        ];
        /* return parent::toArray($request); */
    }
}
