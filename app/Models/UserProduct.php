<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserProduct
 * @package App\Models
 * @version January 20, 2021, 9:41 am UTC
 *
 * @property integer $product_id
 * @property integer $user_id
 */
class UserProduct extends Model
{
    use SoftDeletes;

    public $table = 'user_products';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'product_id',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
