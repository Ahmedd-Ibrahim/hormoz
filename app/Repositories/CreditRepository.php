<?php

namespace App\Repositories;

use App\Models\Credit;
use App\Repositories\BaseRepository;

/**
 * Class CreditRepository
 * @package App\Repositories
 * @version January 20, 2021, 12:53 am UTC
*/

class CreditRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'name',
        'number',
        'expire_date',
        'cvv'
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
        return Credit::class;
    }
}
