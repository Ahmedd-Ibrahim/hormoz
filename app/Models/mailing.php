<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class mailing
 * @package App\Models
 * @version January 26, 2021, 11:29 am UTC
 *
 * @property string $email
 */
class mailing extends Model
{

    public $table = 'mailings';




    public $fillable = [
        'email'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'email' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'email' => 'required|unique:mailings,email,',
    ];


}
