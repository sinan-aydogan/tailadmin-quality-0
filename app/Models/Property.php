<?php

namespace App\Models;

use App\Relations\GetRelatedData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
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
        'property_type_id',
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

    //PROPERTY TYPE
    /**
     * Get the property type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class)->withDefault(['name' => 'Undefined']);
    }
}
