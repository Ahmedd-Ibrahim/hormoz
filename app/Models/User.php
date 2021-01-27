<?php

namespace App\Models;

use Eloquent as Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User
 * @package App\Models
 * @version November 12, 2020, 10:03 am UTC
 *
 * @property string $name
 * @property string $email
 * @property string $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property string $role
 */
class User extends Model
{

    public $table = 'users';


    protected $hidden = ['password','pivot'];

    public $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'phone',
        'role'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'remember_token' => 'string',
        'role' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'email' => 'sometimes|unique:users,email,',
        'phone' => 'required|unique:users,phone,',
        'name' => 'required',
        'password' => 'required',
    ];



}
