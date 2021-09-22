<?php

namespace App\Models;

use App\Relations\GetRelatedData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuditFirm extends Model
{
    use HasFactory;
    use SoftDeletes;
    use GetRelatedData;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'notified_body_number',
        'local_accreditation_numbers',
        'audit_firm_type_id',
        'email',
        'phone',
        'address',
        'status',
        'creator_id',
        'updater_id',
        'deleter_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'audit_firm_type_id' => 'array',
        'local_accreditation_numbers' => 'array'
    ];
}
