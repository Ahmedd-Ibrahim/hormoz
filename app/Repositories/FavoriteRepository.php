<?php

namespace App\Repositories;

use App\Models\Favorite;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class FavoriteRepository
 * @package App\Repositories
 * @version January 27, 2021, 12:10 pm UTC
*/

class FavoriteRepository extends BaseRepository
{
    /**
     * @var array
     */

    public $errors;
    protected $fieldSearchable = [
        'user_id',
        'product_id'
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
        return Favorite::class;
    }


    public function create($input)
    {
        $product = Product::find($input['product_id']);
        if(!$product) {
            return $this->errors = 'NO products had this name';
        }
        if (Auth::guard('api')->user()) {
            $this->getCurrentUser()->ProductFavorites()->sync($input['product_id']);
            return 'Added';
        }

        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
    }


    public function removeFromFavorite($id)
    {
        $product = Product::find($id);
        if(!$product) {
            return;
        }
        $this->getCurrentUser()->ProductFavorites()->detach($product);
        return 'removed';
    }

    public function getFavoritesForCurrentUser()
    {
        if(Auth::guard('api')->user()) {
            return $this->getCurrentUser()->ProductFavorites;
        }
        return $this->errors = 'Login To get Favorites';
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
