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
        'first_name' => 'string',
        'last_name' => 'string',
        'city' => 'string',
        'street' => 'string',
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

        'user_id' => 'required',
        'first_name' => 'required',
        'last_name' => 'required',
        'city' => 'required',
        'street' => 'required',
        'building_number' => 'required',
        'apartment_number' => 'required',
        'phone' => 'required',
        'type' => 'required',
        'description' => 'sometimes'
    ];

    public function User()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class,'address_id');
    }


}
