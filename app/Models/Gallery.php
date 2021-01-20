<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Gallery
 * @package App\Models
 * @version January 20, 2021, 9:20 am UTC
 *
 * @property string $image
 * @property string $is_primary
 * @property integer $product_id
 */
class Gallery extends Model
{
    use SoftDeletes;

    public $table = 'galleries';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'image',
        'is_primary',
        'product_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'image' => 'string',
        'is_primary' => 'string',
        'product_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'image' => 'required',
        'is_primary' => 'required',
        'product_id' => 'required'
    ];


}
