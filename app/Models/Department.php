<?php

namespace App\Models;

use App\Relations\HasMachines;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class Department extends Model
{
    use HasFactory;
    use Notifiable;
    use HasMachines;

    protected $fillable = ['name','manager_id','department_type','department_id','is_complaint','is_production','creator_id','updater_id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deleted_at' => 'datetime',
    ];


/*    public function getComplaintAttribute(){
        return [
                0 => '<i class="text-red-500 fas fa-times-circle"></i>',
                1 => '<i class="text-green-500 fas fa-check-circle "></i>',
            ][$this->is_complaint] ?? '<i class="text-gray-500 fas fa-exclamation-circle"></i>';
    }

    public function getProductionAttribute()
    {
        return [
                0 => '<i class="text-red-500 fas fa-times-circle"></i>',
                1 => '<i class="text-green-500 fas fa-check-circle "></i>',
            ][$this->is_production] ?? '<i class="text-gray-500 fas fa-exclamation-circle"></i>';
    }*/

    //MANAGER
    public function manager()
    {
        return $this->belongsTo(User::class,'manager_id','id')->withDefault(['name' => 'Undefined']);
    }

    //MAIN DEPARTMENT
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id')->withDefault(['name' => 'Main Department']);
    }

}
