<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterialType extends Model
{
    use HasFactory;

    protected $fillable = ['name','department_id','description','creator_id','updater_id '];

    //RELATED DEPARTMENT
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id')->withDefault(['name' => '']);
    }
}
