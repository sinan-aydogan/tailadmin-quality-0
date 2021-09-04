<?php

namespace App\Models;

use App\Relations\GetSearchData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobDescription extends Model
{
    use HasFactory;
    use SoftDeletes;
    use GetSearchData;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'job_responsibility'=>'array',
        'job_requirement'=>'array',
        'report_to'=>'array',
        'working_together'=>'array',
        'working_conditions'=>'array',
        'working_equipments'=>'array',
        'kpi'=>'array',
    ];

    /*Relations*/

    //RELATED DEPARTMENT
    /**
     * Get the department.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id')->withDefault(['name' => 'Independent']);
    }
}
