<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffResource extends JsonResource
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
            'photo' => $this->profile_photo_path,
            'department_id' => $this->department_id,
            'department_name' => $this->department->name,
            'job_description_id' => $this->job_description_id,
            'job_description_name' => $this->jobDescription->name,
            'manager_name' => $this->manager->name,
            'status' => $this->status
        ];
    }
}
