<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

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
    public $error;

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

    public function create($input)
    {
        if(Auth::guard('api')->user()) {

            $input['vendor_id'] = $this->currentUserVendor()->id;

            $input['code'] = rand(100000,10000000);

            $input['status'] = 'active';
        }
        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
    }



    public function getAllProductsForCurrentVendor()
    {
        return $this->currentUserVendor()->Products;
    }


    private function getCurrentUser()
    {
        if(Auth::guard('api')) {
            return   JWTAuth::toUser(JWTAuth::getToken());
        }
        return Auth::user();
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

    private function alertError()
    {
        if(!empty($this->error)) {

            return  $this->error;
        }
    }

}
