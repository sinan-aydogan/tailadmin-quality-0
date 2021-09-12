<?php

namespace App\Models;

use App\Relations\GetRelatedData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
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
        'tax_id',
        'email',
        'phone',
        'address',
        'status',
        'creator_id',
        'updater_id',
        'deleter_id'
    ];

    /*Raw Materials*/
    /**
     * The raw materials that belong to the supplier.
     */
    public function rawMaterials()
    {
        return $this->belongsToMany(RawMaterial::class);
    }
}
