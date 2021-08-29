<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RawMaterial extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code','name','model','description','manufacturer','department_id','raw_material_type_id','package_type','supplier_id','stock_rules','creator_id','updater_id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'storage_condition'=>'array',
        'package_type'=>'array',
    ];

    /*Relations*/

    //RAW MATERIAL TYPE
    /**
     * Get the raw material type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rawMaterialType()
    {
        return $this->belongsTo(RawMaterialType::class,'raw_material_type_id','id')->withDefault(['name' => 'Undefined']);
    }

    //RELATED DEPARTMENT
    /**
     * Get the department.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id')->withDefault(['name' => '']);
    }
}
