<?php

namespace App\Models;

use App\Relations\GetRelatedData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model  implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
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
        'department_id',
        'product_type_id',
        'description',
        'is_certified',
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
        return $this->belongsTo(Department::class, 'department_id', 'id')->withDefault(['name' => 'Undefined']);
    }

    //PRODUCT TYPE
    /**
     * Get the product type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id', 'id')->withDefault(['name' => 'Undefined']);
    }

    //RELATED STANDARDS
    /**
     * Get all of the standards for the raw material.
     */
    public function standards()
    {
        return $this->morphToMany(Standard::class, 'standardables');
    }

    /*Product Photo Linking*/
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('photo')
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('thumbnail')
                    ->format(Manipulations::FORMAT_PNG)
                    ->fit(Manipulations::FIT_CROP, 250, 250);
            });
    }
}
