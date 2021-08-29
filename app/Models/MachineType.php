<?php

namespace App\Models;

use App\Relations\HasMachines;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MachineType extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasMachines;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','creator_id','updater_id'];
  
}

