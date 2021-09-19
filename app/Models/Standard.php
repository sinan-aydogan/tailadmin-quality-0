<?php

namespace App\Models;

use App\Relations\GetRelatedData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Standard extends Model
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
        'name',
        'code',
        'standard_type',
        'department_id',
        'scope',
        'referred_standards',
        'status',
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
        'referred_standards' => 'array'
    ];

    //DEPARTMENT
    /**
     * Get the department.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class)->withDefault(['name' => '']);
    }

    //RELATED ITEMS WITH STANDARD
    /**
     * The related items that belong to the standard.
     */
    /**
     * Get all of the products that are assigned this standard.
     */
    public function products()
    {
        return $this->morphedByMany(Product::class, 'standardables');
    }

    /**
     * Get all of the raw materials that are assigned this standard.
     */
    public function rawMaterials()
    {
        return $this->morphedByMany(RawMaterial::class, 'standardables');
    }
}
