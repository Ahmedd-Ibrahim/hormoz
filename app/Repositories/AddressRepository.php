<?php

namespace App\Repositories;

use App\Models\Address;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class AddressRepository
 * @package App\Repositories
 * @version January 20, 2021, 8:39 am UTC
*/

class AddressRepository extends BaseRepository
{
    /**
     * @var array
     */

    public $errors;

    protected $fieldSearchable = [
        'user_id',
        'first_name',
        'last_name',
        'city',
        'street',
        'building_number',
        'apartment_number',
        'phone',
        'type',
        'descriotion'
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
        return Address::class;
    }


    public function updateAddress($input)
    {
        if(!isset($input['id'])) {
            return $this->errors = 'Address Id should be sent inside the form';
        }

        $address = Address::find($input['id']);
        if (!$address) {
            return $this->errors = 'No Address on this ID';
        }

        $address->update($input);

        return $address;
    }
    public function getUserAddress()
    {
        if($this->getCurrentUser()->Addresses) {
            return $this->getCurrentUser()->Addresses;
        }

        return $this->errors = 'no Address yet';
    }

    public function create($input)
    {
        if(Auth::guard('api')->user())
        {
            $input['user_id'] = $this->getCurrentUser()->id;
        }

        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
    }
    private function getCurrentUser()
    {
        if(Auth::guard('api')) {
            return   JWTAuth::toUser(JWTAuth::getToken());
        }
        return Auth::user();
    }


    private function alertError()
    {
        if(!empty($this->errors)) {
            return  $this->errors;
        }
    }
}
