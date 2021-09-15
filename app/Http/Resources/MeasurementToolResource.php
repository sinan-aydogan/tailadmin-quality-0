<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MeasurementToolResource extends JsonResource
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
            'measurement_tool_type_id' => $this->measurement_tool_type_id,
            'measurement_tool_type_name' => $this->type->name,
            'serial_no' => $this->serial_no,
            'manufacturer' => $this->manufacturer,
            'model' => $this->model,
            'department_id' => $this->department_id,
            'department_name' => $this->department->name,
            'operator_id' => $this->operator_id,
            'operator_name' => $this->operator->name,
            'action_manager_id' => $this->action_manager_id,
            'action_manager_name' => $this->actionManager->name,
            'status' => $this->status,
        ];
    }
}
