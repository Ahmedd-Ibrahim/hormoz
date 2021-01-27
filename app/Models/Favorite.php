<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Favorite
 * @package App\Models
 * @version January 27, 2021, 12:10 pm UTC
 *
 * @property integer $user_id
 * @property integer $product_id
 */
class Favorite extends Model
{

    public $table = 'favorites';


    public $fillable = [
        'user_id',
        'product_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'product_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'required'

    ];


}
