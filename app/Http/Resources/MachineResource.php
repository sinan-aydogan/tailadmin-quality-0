<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MachineResource extends JsonResource
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
            'code' => $this->code,
            'name' => $this->name,
            'machine_type_id' => $this->machine_type_id,
            'machine_type_name' => $this->machineType->name,
            'department_id' => $this->department_id,
            'department_name' => $this->department->name,
            'machine_id' => $this->machine_id,
            'machine_name' => $this->machine->name,
            'model' => $this->model,
            'manufacturer' => $this->manufacturer,
        ];
    }
}
