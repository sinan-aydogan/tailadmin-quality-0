<?php

namespace App\Models;

use App\Relations\GetRelatedData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Department extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use GetRelatedData;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'manager_id',
        'department_type',
        'department_id',
        'is_complaint',
        'is_production',
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
        'deleted_at' => 'datetime',
    ];

    /*Relations*/

    //MANAGER
    /**
     * Get the manager.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id', 'id')->withDefault(['name' => 'Undefined']);
    }

    //MAIN DEPARTMENT
    /**
     * Get the main department.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id')->withDefault(['name' => 'Main Department']);
    }

    //RELATED STANDARDS
    /**
     * Get all of the standards for the raw material.
     */
    public function standards()
    {
        return $this->morphToMany(Standard::class, 'standardables');
    }
}
