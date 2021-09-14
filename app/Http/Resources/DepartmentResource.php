<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
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
            'department_type' => $this->department_type,
            'main_department_id' => $this->department_id,
            'main_department_name' => $this->department->name,
            'is_production' => $this->is_production,
            'is_complaint' => $this->is_complaint,
            'manager_id' => $this->manager_id,
            'manager_name' => $this->manager->name,
            'manager_photo' => $this->manager->profile_photo_path
        ];
    }
}
