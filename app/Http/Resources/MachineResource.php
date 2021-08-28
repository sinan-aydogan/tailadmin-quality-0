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
            'model' => $this->model,
            'manufacturer' => $this->manufacturer,
            'department_id' => $this->department_id,
            'department' => $this->department->name,
            'machine_type_id' => $this->machine_type_id,
            'machineType' => $this->machineType->name,
            'machine_id' => $this->machine_id,
            'mainMachine' => $this->machine->name,
        ];
        // return parent::toArray($request);
    }
}
