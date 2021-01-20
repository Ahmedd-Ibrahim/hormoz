<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Order
 * @package App\Models
 * @version January 20, 2021, 9:35 am UTC
 *
 * @property integer $user_id
 * @property integer $order_number
 * @property number $total
 * @property integer $address_id
 * @property string $status
 */
class Order extends Model
{
    use SoftDeletes;

    public $table = 'orders';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'order_number',
        'total',
        'address_id',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'order_number' => 'integer',
        'total' => 'float',
        'address_id' => 'integer',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'order_number' => 'required',
        'total' => 'required',
        'address_id' => 'required',
        'status' => 'required'
    ];

    public function User()
    {
        return $this->belongsTo(\App\User::class,'user_id');
    }

    public function Products()
    {
        return $this->belongsToMany(Order::class,'order_products');
    }

}
