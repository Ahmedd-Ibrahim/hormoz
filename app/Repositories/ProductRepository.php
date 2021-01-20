<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\BaseRepository;

/**
 * Class ProductRepository
 * @package App\Repositories
 * @version January 20, 2021, 8:59 am UTC
*/

class ProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'vendor_id',
        'name',
        'category_id',
        'maxmim_stock_for_client',
        'weight',
        'sku',
        'description',
        'stock',
        'regluar_price',
        'is_sale',
        'sale_precent',
        'sale_expire_date',
        'catching_word',
        'code',
        'status',
        'brand'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Product::class;
    }
}
