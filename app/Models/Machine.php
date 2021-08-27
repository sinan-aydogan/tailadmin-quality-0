<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Machine extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code','name','machine_type_id','department_id','machine_id','creator_id','updater_id'];

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function machineType()
    {
        return $this->belongsTo(MachineType::class,'machine_type_id','id')->withDefault(['name' => 'Undefined Machine']);
    }

    //MACHINE
    /**
     * Get the machine.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function machine()
    {
        return $this->belongsTo(Machine::class,'machine_id','id')->withDefault(['name' => 'Undefined Machine Type']);
    }

    //DEPARTMENT
    /**
     * Get the department.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id')->withDefault(['name' => 'Undefined Department']);
    }
}
