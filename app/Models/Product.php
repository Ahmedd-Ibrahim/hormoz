<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App\Models
 * @version January 20, 2021, 8:59 am UTC
 *
 * @property integer $vendor_id
 * @property string $name
 * @property integer $category_id
 * @property integer $maxmim_stock_for_client
 * @property number $weight
 * @property string $sku
 * @property string $description
 * @property integer $stock
 * @property number $regluar_price
 * @property integer $is_sale
 * @property number $sale_precent
 * @property string $sale_expire_date
 * @property string $catching_word
 * @property string $code
 * @property string $status
 * @property string $brand
 */
class Product extends Model
{
    use SoftDeletes;

    public $table = 'products';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'vendor_id',
        'name',
        'category_id',
        'maximum_stock_for_client',
        'weight',
        'sku',
        'description',
        'stock',
        'regular_price',
        'is_sale',
        'sale_percent',
        'sale_expire_date',
        'catching_word',
        'code',
        'status',
        'brand'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'vendor_id' => 'integer',
        'name' => 'string',
        'category_id' => 'integer',
        'maxmim_stock_for_client' => 'integer',
        'weight' => 'float',
        'sku' => 'string',
        'stock' => 'integer',
        'regluar_price' => 'float',
        'is_sale' => 'integer',
        'sale_percent' => 'float',
        'sale_expire_date' => 'date',
        'catching_word' => 'string',
        'code' => 'string',
        'status' => 'string',
        'brand' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function Vendor()
    {
        return $this->belongsTo(Vendor::class,'vendor_id');
    }

    public function Category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function Users()
    {
        return $this->belongsToMany(Product::class,'user_product','user_id');
    }

    public function Orders()
    {
        return $this->belongsToMany(Order::class,'order_products');
    }
}
