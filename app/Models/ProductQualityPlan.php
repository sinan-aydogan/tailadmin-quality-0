<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductQualityPlan extends Model
{
    use HasFactory;

    protected $fillable = [
      'code',
      'product_id',
    ];
}
