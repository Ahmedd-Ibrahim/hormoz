<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\UserProduct;
use App\Repositories\BaseRepository;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

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
    public $errors;
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


    public function card()
    {

        if(Auth::guard('api')->user()) {
            $products = DB::table('user_products')
                ->select(DB::raw('count(*) as count ,product_id'))
                ->where('user_id',$this->getCurrentUser()->id)->groupBy('product_id')->get();

            return $products;
        }
        $this->errors = 'You need to Login';
        return $this->errors;
    }

    public function create($input)
    {
        $product = Product::find($input['product_id']);

        if(!$product) {
            $this->errors = 'no product on this id';
            return $this->alertError();
        }

        if(isset($input['count']) && $input['count'] > 1){
            return $this->insertMultiRecords($input);
        }

        if(Auth::guard('api')->user()) {
            $input['user_id'] = $this->getCurrentUser()->id;
        }

        $user = $this->getCurrentUser();
        $user->Products()->attach($input['product_id']);

        return 'added';
    }

    private function insertMultiRecords($input)
    {
        if(Auth::guard('api')->user()) {
            if($input['count'] > 1) {
                for ($i =1; $i <= $input['count']; $i++) {
                    $this->getCurrentUser()->Products()->attach($input['product_id']);
                }
            }
        }

        return 'Added';
    }


    public function delete($id)
    {
        if(Auth::guard('api')->user()) {
            $product =  $this->getCurrentUser()->Products()->find($id);

            if (!$product) {
                return null;
            }

            $this->getCurrentUser()->Products()->detach($id);
            return 'removed';
        }

        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        return $model->delete();
    }


    public function reduceProductFromCart($id)
    {
        if(Auth::guard('api')->user()) {
            $product =  $this->getCurrentUser()->Products()->where('products.id',$id)->get();

            if (!$product) {
                return 'null';
            } elseif ($product->count() == 1) {
                 return $this->errors = 'You can not reduce Under 1';
            }
//            get product from pivot table & delete him once
            try {
                $products = DB::table('user_products')
                   ->where('user_id',$this->getCurrentUser()->id)
                    ->where('product_id',$id)->get();

               foreach ($products as $product) {
                   DB::table('user_products')
                       ->where('user_id',$this->getCurrentUser()->id)
                       ->where('id',$product->id)->delete();
                   return 'success';
               }

            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }

        return 'You need Api token TO use this feature';
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
