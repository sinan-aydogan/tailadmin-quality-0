<?php

namespace App\Models;

use App\Relations\GetRelatedData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RawMaterialQualityPlan extends Model
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
        'department_id',
        'raw_material_id',
        'creator_id',
        'updater_id',
        'deleter_id'
    ];

    /*Relations*/

    //DEPARTMENT
    /**
     * Get the department.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class)->withDefault(['name' => 'Undefined']);
    }

    //RAW MATERIAL
    /**
     * Get the raw material.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class)->withDefault(['name' => 'Undefined']);
    }

    //QUALITY SPECTS FOR RAW MATERIAL
    /**
     * The spects that belong to the raw material.
     */
    public function spects()
    {
        return $this->belongsToMany(Spect::class);
    }
}
