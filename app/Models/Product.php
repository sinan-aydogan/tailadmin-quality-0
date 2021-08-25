<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Manipulations;

class Product extends Model  implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['name','code','department_id','product_type_id','description','is_certified','standard_id','creator_id','updater_id'];

    //DEPARTMENT
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id')->withDefault(['name' => 'Undefined']);
    }

    //STANDARD
    public function standard()
    {
        return $this->belongsTo(Standard::class,'standard_id','id')->withDefault(['name' => 'Undefined']);
    }

    //PRODUCT TYPE
    public function productType()
    {
        return $this->belongsTo(ProductType::class,'product_type_id','id')->withDefault(['name' => 'Undefined']);
    }
   /* protected $appends = ['photo'];

    public function getPhotoAttribute($value)
    {
        return $this->photo = $this->getFirstMediaUrl('photo');
    }*/

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
