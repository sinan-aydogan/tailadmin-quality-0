<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintType extends Model
{
    use HasFactory;

    protected $fillable = ['name','department_id','source','advice','creator_id','updater_id'];

    protected $hidden = ['pivot'];

    //RELATED DEPARTMENT
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id')->withDefault(['name' => 'Main Department']);
    }
}
