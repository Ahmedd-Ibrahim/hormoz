<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Address
 * @package App\Models
 * @version January 20, 2021, 8:39 am UTC
 *
 * @property integer $user_id
 * @property integer $first_name
 * @property integer $last_name
 * @property integer $city
 * @property integer $street
 * @property integer $building_number
 * @property integer $apartment_number
 * @property string $phone
 * @property string $type
 * @property string $descriotion
 */
class Address extends Model
{
    use SoftDeletes;

    public $table = 'addresses';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'city',
        'street',
        'building_number',
        'apartment_number',
        'phone',
        'type',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'first_name' => 'integer',
        'last_name' => 'integer',
        'city' => 'integer',
        'street' => 'integer',
        'building_number' => 'integer',
        'apartment_number' => 'integer',
        'phone' => 'string',
        'type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function User()
    {
        return $this->belongsTo(User::class,'user_id');
    }


}
