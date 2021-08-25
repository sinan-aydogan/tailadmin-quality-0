<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = ['register_date','customer_id','department_id','product_id','description'];

    protected $casts = [
        'register_date'=>'datetime'
    ];
    /**
     * @var mixed
     */

    protected $appends = ['date'];
    /**
     * @var mixed
     */

    public function getDateAttribute(){
        return $this->register_date->format('d-M-Y');
    }

    /*COMPLAINT TYPES FOR EVERY COMPLAINT*/
    public function complaintTypes(){
        return $this->belongsToMany(ComplaintType::class,'complaint_type_complaints','complaint_id','complaint_type_id');
    }

    //RELATED DEPARTMENT
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id')->withDefault(['name' => 'Undefined']);
    }

    //RELATED CUSTOMER
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id')->withDefault(['name' => 'Undefined']);
    }

    //RELATED PRODUCT
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id')->withDefault(['name' => 'Undefined']);
    }
}
