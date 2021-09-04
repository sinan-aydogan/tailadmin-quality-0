<?php

namespace App\Models;

use App\Relations\GetSearchData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class ProductQualityPlan extends Model
{
    use HasFactory;
    use SoftDeletes;
    use GetSearchData;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'department_id',
        'product_id',
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
        return $this->belongsTo(Department::class,'department_id','id')->withDefault(['name' => 'Undefined']);
    }

    //PRODUCT
    /**
     * Get the department.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class,'department_id','id')->withDefault(['name' => 'Undefined']);
    }

    //QUALITY SPECTS FOR PRODUCT
    /**
     * The roles that belong to the user.
     */
    public function product_spects()
    {
        return $this->belongsToMany(Spect::class);
    }
}
