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
        'scope',
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
    /*protected $casts = [];*/

    //RELATED ITEMS WITH STANDARD
    /**
     * The related items that belong to the standard.
     */
    /**
     * Get all of the departments that are assigned this standard.
     */
    public function departments()
    {
        return $this->morphedByMany(Department::class, 'standardables');
    }

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

    /**
     * The related items that belong to the standard.
     */
    /**
     * Get all of the machines that are assigned this standard.
     */
    public function machines()
    {
        return $this->morphedByMany(Machine::class, 'standardables');
    }

    /**
     * The related items that belong to the standard.
     */
    /**
     * Get all of the measurement tools that are assigned this standard.
     */
    public function measurementTools()
    {
        return $this->morphedByMany(MeasurementTool::class, 'standardables');
    }
}
