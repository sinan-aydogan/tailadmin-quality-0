<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;
    /*Fields*/
    protected $fillable = ['code','name','model','manufacturer','machine_type_id','department_id','machine_id',
'creator_id','updater_id'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deleted_at' => 'datetime',
    ];
    //MACHINE TYPE
    public function machineType()
    {
        return $this->belongsTo(MachineType::class,'machine_type_id','id')->withDefault(['name'
        => 'Undefined Machine Type']);
    }
    //MACHINE
    public function machine()
    {
        return $this->belongsTo(Machine::class,'machine_id','id')->withDefault(['name' => 'Undefined Machine']);
    }
    //MAIN DEPARTMENT
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id')->withDefault(['name' => 'Undefined Department']);
    }
}
