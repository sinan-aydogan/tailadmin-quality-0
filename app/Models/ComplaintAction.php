<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintAction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','action_type','comment'];

    /* Complaint Realiton */

    public function complaint(){

    }
}
