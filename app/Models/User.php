<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
/*Spatie Permissions Package*/
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;
    /*Spatie Permissions Package*/
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'department_id',
        'job_description_id',
        'collar_type',
        'manager_id',
        'directed_staff',
        'citizen_id',
        'status',
        'starting_date',
        'birthday_date',
        'leaving_date',
        'leaving_reason',
        'blood_group',
        'phone',
        'address',
        'emergency_contact',
        'education_info',
        'skill_info',
        'additional_task',
        'creator_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'starting_date'=>'datetime',
        'birthday_date'=>'datetime',
        'leaving_date'=>'datetime',
        'directed_staff'=>'array',
        'phone'=>'array',
        'emergency_contact'=>'array',
        'education_info'=>'array',
        'skill_info'=>'array',
        'additional_task'=>'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    //MANAGER
    public function manager()
    {
        return $this->belongsTo(User::class,'manager_id','id')->withDefault(['name' => 'Undefined']);
    }

    //MAIN DEPARTMENT
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id')->withDefault(['name' => 'Undefined']);
    }

    //JOB DESCRIPTION
    public function jobDescription()
    {
        return $this->belongsTo(JobDescription::class,'job_description_id','id')->withDefault(['name' => 'Undefined']);
    }
}
