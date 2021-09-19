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
            'department_id'=> $this->department_id,
            'department_name'=> $this->department->name,
            'scope'=> $this->scope,
            'refered_standards'=> $this->refered_standards,
            'status'=> $this->status,
            'related_items'=> $this->related_items,
        ];
    }
}
