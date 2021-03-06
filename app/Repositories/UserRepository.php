<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version November 12, 2020, 10:03 am UTC
*/

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */

    public $errors;

    protected $fieldSearchable = [
        'name',
        'email',
        'phone',
        'role'
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
        return User::class;
    }

    public function create($input)
    {
        $password = Hash::make($input['password']);
        $input['password'] = $password;
        $model = $this->model->newInstance($input);
        $model->save();

        return $model;
    }

    public function update($input, $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        $password = Hash::make($input['password']);
        $input['password'] = $password;
        $model->fill($input);

        $model->save();

        return $model;
    }

    public function getUserInfo()
    {
        return $this->getCurrentUser();
    }


    public function updateProfile($input)
    {
       if(Auth::guard('api')->user()) {
           $user = $this->getCurrentUser();
           $user->update($input);
           return $user;
       }
    }

    public function updatePass($input)
    {

        if(Hash::check($input['old_password'],$this->getCurrentUser()->password)) {
            $user = $this->getCurrentUser();
            $user->update(['password' => Hash::make($input['password'])]);
            return 'done';
        }

        return $this->errors = 'password not matching';

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
