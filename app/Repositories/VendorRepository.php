<?php

namespace App\Repositories;

use App\Models\Vendor;
use App\Repositories\BaseRepository;

/**
 * Class VendorRepository
 * @package App\Repositories
 * @version January 20, 2021, 8:53 am UTC
*/

class VendorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return Vendor::class;
    }
}
