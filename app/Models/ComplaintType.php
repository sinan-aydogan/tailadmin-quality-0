<?php

namespace App\Models;

use App\Relations\GetRelatedData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComplaintType extends Model
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
        'department_id',
        'source',
        'advice',
        'creator_id',
        'updater_id',
        'deleter_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['pivot'];

    /*Relations*/

    //RELATED DEPARTMENT
    /**
     * Get the department.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id')->withDefault(['name' => 'Main Department']);
    }
}
