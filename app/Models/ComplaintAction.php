<?php

namespace App\Models;

use App\Relations\GetSearchData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComplaintAction extends Model
{
    use HasFactory;
    use SoftDeletes;
    use GetSearchData;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','action_type','comment'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    /*protected $casts = [];*/
}
