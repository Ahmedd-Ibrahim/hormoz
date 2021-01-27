<?php

namespace App\Repositories;

use App\Models\mailing;
use App\Repositories\BaseRepository;

/**
 * Class mailingRepository
 * @package App\Repositories
 * @version January 26, 2021, 11:29 am UTC
*/

class mailingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'email'
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
        return mailing::class;
    }
}
