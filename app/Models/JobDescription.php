<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'summary',
        'collar_type',
        'department_id',
        'job_responsibility',
        'job_requirement',
        'report_to',
        'working_together',
        'working_conditions',
        'working_equipments',
        'kpi',
        'creator_id'
    ];

    protected $casts = [
        'job_responsibility'=>'array',
        'job_requirement'=>'array',
        'report_to'=>'array',
        'working_together'=>'array',
        'working_conditions'=>'array',
        'working_equipments'=>'array',
        'kpi'=>'array',
    ];

    //RELATED DEPARTMENT
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id')->withDefault(['name' => 'Independent']);
    }
}
