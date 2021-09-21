<?php

namespace App\Models;

use App\Relations\GetRelatedData;
use App\Relations\HasProperties;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class RawMaterial extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use GetRelatedData;
    use InteractsWithMedia;
    use HasProperties;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'model',
        'description',
        'manufacturer',
        'department_id',
        'raw_material_type_id',
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

    /*Relations*/

    //RAW MATERIAL TYPE
    /**
     * Get the raw material type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rawMaterialType()
    {
        return $this->belongsTo(RawMaterialType::class, 'raw_material_type_id', 'id')->withDefault(['name' => 'Undefined']);
    }

    //RELATED DEPARTMENT
    /**
     * Get the department.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id')->withDefault(['name' => '']);
    }

    //SUPPLIERS FOR RAW MATERIAL
    /**
     * The suppliers that belong to the raw material.
     */
    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class);
    }

    //RELATED STANDARDS
    /**
     * Get all of the standards for the raw material.
     */
    public function standards()
    {
        return $this->morphToMany(Standard::class, 'standardables');
    }

    /*Raw Material File Linking*/
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('file')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('thumbnail')
                    ->format(Manipulations::FORMAT_PNG)
                    ->fit(Manipulations::FIT_CROP, 250, 250);
            });
    }
}
