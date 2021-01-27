<?php

namespace App\Repositories;

use App\Models\Vendor;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;


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
    public $errors = [];

    protected $fieldSearchable = [
        'user_id',
        'email',
        'name',
        'official_name',
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

    public function create($input)
    {
        if(Auth::guard('api')->user()) {

            if ($this->checkVendorCount($this->getCurrentUser()) != 0) {
                return  $this->errors = 'can not has more than one vendor';
            }

            $input['user_id'] = $this->getCurrentUser()->id;
        }

        if(isset($input['Legal_papers']) && is_file($input['Legal_papers'])) {

            $paper =  UploadImage('vendor',$input['Legal_papers']);

            $input['Legal_papers'] = $paper;
        }

        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
    }


    public function update($input, $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        if($model->Legal_papers){
            RemoveImageFromDisk('images'.DIRECTORY_SEPARATOR.$model->Legal_papers);
        }

        if(isset($input['Legal_papers']) && is_file($input['Legal_papers']))
        {
            $paper =  UploadImage('vendor',$input['Legal_papers']);
            $input['Legal_papers'] = $paper;
        }

        $model->fill($input);

        $model->save();

        return $model;
    }


    public function delete($id)
    {

        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);
        if($model->Legal_papers){
            RemoveImageFromDisk('images'.DIRECTORY_SEPARATOR.$model->Legal_papers);
        }

        return $model->delete();
    }
    /*
     * complete vendor profile upload legal
     * @return boolean
     * */
    public function legal($input)
    {
        $validator = Validator::make($input, [

            'Legal_papers' => 'required|file|mimes:pdf,jpg,png',
        ]);

        if($validator->fails()){

            return $this->errors = $validator->errors();
        }

        if(isset($input['Legal_papers']) && is_file($input['Legal_papers'])) {

            $paper =  UploadImage('vendor',$input['Legal_papers']);

            $input['Legal_papers'] = $paper;
        }else{

            return $this->errors = 'something Wrong check form Conditions!';
        }

        return $this->getCurrentUser()->Vendors()->first()->update($input);
    }

    /*
     * update user bank
     *
     * @return boolean
     *
     * */

    public function UpdateUserBank($input)
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            return $this->errors = 'User not found';
        }
       return $user->Vendors()->first()->update($input);
    }

    public function getTotalBalance()
    {
        return  $this->getCurrentUser()->Vendors()->select('id','total','holding','available')->first();
    }


    public function getHoldingBalance()
    {
        return $this->currentUserVendor()->holding;
    }
    /*
     * get vendors of user count
     *
     * @return integer
     *
     * */
    private function checkVendorCount($user)
    {
        return $user->Vendors()->count();
    }

    private function currentUserVendor()
    {
        if(!$this->getCurrentUser()) {

            $this->error = 'user must login';

            return $this->alertError();

        } elseif (!$this->getCurrentUser()->has('Vendors')) {

            $this->error = 'user must have at lest one vendor';

            return $this->alertError();

        }

        return $this->getCurrentUser()->Vendors()->first();
    }


    /*
     * get current user
     *
     * @return instance of user
     * */
    private function getCurrentUser()
    {
        if(Auth::guard('api')) {
            return   JWTAuth::toUser(JWTAuth::getToken());
        }
        return Auth::user();
    }


    private function alertError()
    {
        if(!empty($this->error)) {
            return  $this->error;
        }
    }

}
