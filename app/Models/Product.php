<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Manipulations;

class Product extends Model  implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','code','department_id','product_type_id','description','is_certified','standard_id','creator_id','updater_id'];

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

    //STANDARD
    /**
     * Get the standard.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function standard()
    {
        return $this->belongsTo(Standard::class,'standard_id','id')->withDefault(['name' => 'Undefined']);
    }

    //PRODUCT TYPE
    /**
     * Get the product type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productType()
    {
        return $this->belongsTo(ProductType::class,'product_type_id','id')->withDefault(['name' => 'Undefined']);
    }

    /*Prodyct Photo Linking*/
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
