<?php

namespace App\Models;

use App\Relations\GetRelatedData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Machine extends Model
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
        'code',
        'name',
        'model',
        'manufacturer',
        'machine_type_id',
        'department_id',
        'machine_id',
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

    //MACHINE TYPE
    /**
     * Get the machine type.
     *
     * @return BelongsTo
     */
    public function machineType()
    {
        return $this->belongsTo(MachineType::class, 'machine_type_id', 'id')->withDefault(['name' => 'Undefined Machine Type']);
    }

    //MACHINE
    /**
     * Get the machine.
     *
     * @return BelongsTo
     */
    public function machine()
    {
        return $this->belongsTo(Machine::class, 'machine_id', 'id')->withDefault(['name' => 'Undefined']);
    }

    //DEPARTMENT
    /**
     * Get the department.
     *
     * @return BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id')->withDefault(['name' => 'Undefined']);
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
