<?php

namespace App\Repositories;

use App\Models\OrderProduct;
use App\Repositories\BaseRepository;

/**
 * Class OrderProductRepository
 * @package App\Repositories
 * @version January 20, 2021, 9:45 am UTC
*/

class OrderProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_id',
        'product_id',
        'price'
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
        return OrderProduct::class;
    }
}
