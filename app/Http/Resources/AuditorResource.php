<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuditorResource extends JsonResource
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
            'title' => $this->title,
            'audit_firm_id' => $this->audit_firm_id,
            'email' => $this->email,
            'phone' => $this->phone,
            'notes' => $this->notes,
            'files' => $this->files,
            'status' => $this->status
        ];
    }
}
