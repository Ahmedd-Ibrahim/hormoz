<?php

namespace App\Repositories;

use App\Models\UserProduct;
use App\Repositories\BaseRepository;

/**
 * Class UserProductRepository
 * @package App\Repositories
 * @version January 20, 2021, 9:41 am UTC
*/

class UserProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'user_id'
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
        return UserProduct::class;
    }
}
