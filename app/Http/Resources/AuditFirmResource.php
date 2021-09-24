<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuditFirmResource extends JsonResource
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
            'notified_body_number' => $this->notified_body_number,
            'local_accreditation_numbers' => $this->local_accreditation_numbers,
            'audit_firm_type_id' => $this->audit_firm_type_id,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'audit_types' => $this->auditTypes,
            'status' => $this->status
        ];
    }
}
