<?php

namespace App\Models;

use App\Relations\GetRelatedData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spect extends Model
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
        'spect_id',
        'limit_type_id',
        'rule_id',
        'value',
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

    protected $hidden = ['pivot'];

    //SPECT
    /**
     * Get the spect.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quality_spect()
    {
        return $this->belongsTo(QualitySpect::class,'spect_id','id');
    }
}
