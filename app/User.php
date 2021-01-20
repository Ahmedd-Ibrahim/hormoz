<?php

namespace App;

use App\Models\Address;
use App\Models\Credit;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Models\Vendor;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'password','role','email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function Credit()
    {
        return $this->hasMany(Credit::class,'user_id');
    }

    public function Addresses()
    {
        return $this->hasMany(Address::class,'user_id');
    }

    public function Vendors()
    {
        return $this->hasMany(Vendor::class,'user_id');
    }

    public function Orders()
    {
        return $this->hasMany(Order::class,'user_id');
    }

    public function Products()
    {
        return $this->belongsToMany(Product::class,'user_product','product_id');
    }
}
