<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Credit
 * @package App\Models
 * @version January 20, 2021, 12:53 am UTC
 *
 * @property integer $user_id
 * @property string $name
 * @property string $number
 * @property string $expire_date
 * @property string $cvv
 */
class Credit extends Model
{
    use SoftDeletes;

    public $table = 'credits';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'name',
        'number',
        'expire_date',
        'cvv'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'name' => 'string',
        'number' => 'string',
        'expire_date' => 'datetime',
        'cvv' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id'=>'required',
        'name'=>'required',
        'number'=>'required',
        'expire_date'=>'required',
        'cvv'=>'required'
    ];


    public function User()
    {
        return $this->belongsToMany(\App\User::class,'user_id');
    }
}
