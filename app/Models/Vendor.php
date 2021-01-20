<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Vendor
 * @package App\Models
 * @version January 20, 2021, 8:53 am UTC
 *
 * @property integer $user_id
 * @property string $email
 * @property string $name
 * @property string $offcial_name
 * @property string $phone
 * @property string $address
 * @property string $Legal_papers
 * @property string $is_active
 * @property number $available
 * @property number $holding
 * @property number $total
 * @property string $owner_name
 * @property string $bank_name
 * @property string $branch_name
 * @property integer $account_id
 * @property string $iban
 */
class Vendor extends Model
{
    use SoftDeletes;

    public $table = 'vendors';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'email',
        'name',
        'offcial_name',
        'phone',
        'address',
        'Legal_papers',
        'is_active',
        'available',
        'holding',
        'total',
        'owner_name',
        'bank_name',
        'branch_name',
        'account_id',
        'iban'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'email' => 'string',
        'name' => 'string',
        'offcial_name' => 'string',
        'phone' => 'string',
        'address' => 'string',
        'Legal_papers' => 'string',
        'is_active' => 'string',
        'available' => 'float',
        'holding' => 'float',
        'total' => 'float',
        'owner_name' => 'string',
        'bank_name' => 'string',
        'branch_name' => 'string',
        'account_id' => 'integer',
        'iban' => 'string'
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
        return $this->belongsTo(\App\User::class,'user_id');
    }

    public function Products()
    {
        return $this->hasMany(Product::class,'vendor_id');
    }
}
