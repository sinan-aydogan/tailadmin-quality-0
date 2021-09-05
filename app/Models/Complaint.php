<?php

namespace App\Models;

use App\Relations\GetRelatedData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complaint extends Model
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
        'register_date',
        'customer_id',
        'department_id',
        'product_id',
        'description',
        'creator_id',
        'updater_id',
        'deleter_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'register_date' => 'datetime'
    ];

    /**
     * @var mixed
     */
    protected $appends = ['date'];

    /*Date format correction*/
    public function getDateAttribute()
    {
        return $this->register_date->format('d-M-Y');
    }

    /*Relations*/

    /*COMPLAINT TYPES FOR EVERY COMPLAINT*/
    /**
     * Get the complaint type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function complaintTypes()
    {
        return $this->belongsToMany(ComplaintType::class, 'complaint_type_complaints', 'complaint_id', 'complaint_type_id');
    }

    //RELATED DEPARTMENT
    /**
     * Get the department.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id')->withDefault(['name' => 'Undefined']);
    }

    //RELATED CUSTOMER
    /**
     * Get the customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id')->withDefault(['name' => 'Undefined']);
    }

    //RELATED PRODUCT
    /**
     * Get the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id')->withDefault(['name' => 'Undefined']);
    }
}
