<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    use HasFactory;

    protected $fillable = ['code','name','model','description','manufacturer','department_id','raw_material_type_id','package_type','supplier_id','stock_rules','creator_id','updater_id'];

    protected $casts = [
        'storage_condition'=>'array',
        'package_type'=>'array',
    ];

    //MAIN DEPARTMENT
    public function rawMaterialType()
    {
        return $this->belongsTo(RawMaterialType::class,'raw_material_type_id','id')->withDefault(['name' => 'Undefined']);
    }

    //RELATED DEPARTMENT
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id')->withDefault(['name' => '']);
    }
}
