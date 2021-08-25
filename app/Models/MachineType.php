<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineType extends Model
{
    use HasFactory;
    /*Fields*/
    protected $fillable = ['name','description','creator_id','updater_id'];
}

