<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OrderProduct
 * @package App\Models
 * @version January 20, 2021, 9:45 am UTC
 *
 * @property integer $order_id
 * @property integer $product_id
 * @property number $price
 */
class OrderProduct extends Model
{
    use SoftDeletes;

    public $table = 'order_products';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'order_id',
        'product_id',
        'price'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'order_id' => 'integer',
        'product_id' => 'integer',
        'price' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'order_id' => 'required',
        'product_id' => 'required',
        'price'=> 'sometimes'
    ];


}
