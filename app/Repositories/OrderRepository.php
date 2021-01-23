<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Matrix\Exception;
use phpDocumentor\Reflection\Types\True_;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class OrderRepository
 * @package App\Repositories
 * @version January 20, 2021, 9:35 am UTC
*/

class OrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'order_number',
        'total',
        'address_id',
        'status'
    ];
    /**
     * @var string
     */
    public $error = [];

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
        return Order::class;
    }

    public function getVendorOrdersTotalCount()
    {
         if(!$this->currentUserVendor()) {

             $this->error = 'no Vendor exists';

             return $this->alertError();
         }

        return Order::whereHas('Products', function (Builder $query) {

            $query->where('vendor_id', $this->currentUserVendor()->id);

        })->count();
    }

    public function getVendorOrdersWaitingCount()
    {
        return Order::whereHas('Products',function (Builder $query) {

            $query->where('vendor_id',$this->currentUserVendor()->id);

        })->where('status','waiting')->count();
    }

    public function getVendorOrderPreparingCount()
    {

        return Order::whereHas('Products',function (Builder $query) {

            $query->where('vendor_id',$this->currentUserVendor()->id);

        })->where('status','preparing')->count();
    }


    public function getVendorOrderWaitDeliveryCount()
    {

        return Order::whereHas('Products',function (Builder $query) {

            $query->where('vendor_id',$this->currentUserVendor()->id);

        })->where('status','wait_delivery')->count();
    }


    public function getVendorOrderOnDeliveringCount()
    {

        return Order::whereHas('Products',function (Builder $query) {

            $query->where('vendor_id',$this->currentUserVendor()->id);

        })->where('status','delivering')->count();
    }


    public function getVendorOrderComplectedCount()
    {

        return Order::whereHas('Products',function (Builder $query) {

            $query->where('vendor_id',$this->currentUserVendor()->id);

        })->where('status','complected')->count();
    }

    public function getVendorOrderCanceledCount()
    {

        return Order::whereHas('Products',function (Builder $query) {

            $query->where('vendor_id',$this->currentUserVendor()->id);

        })->where('status','canceled')->count();
    }


    /*
   * get history of orders
   *
   * */
    public function vendorOrderHistory()
    {
        $orders = Order::whereHas('products',function (Builder $query){
            $query->where('vendor_id',$this->currentUserVendor()->id);
        })->get();

        if (empty($orders)) {
            $this->error = 'no orders yet';
            return $this->alertError();
        }

        $orderBox = [];

        foreach ($orders as $order) {

            $orderBox[]  = [
               'total' => $order->total = $this->getTotalPriceForEveryOrder($order),

               'address' => $order->total = $order->Address->city,

               'order_number' => $order->order_number,

               'created_at' => $order->created_at,

               'order_status' => $order->order_status,
            ];
        }

        return $orderBox;
    }

    public function test()
    {
        $orders = Order::first();

        return $orders->Products()->updateExistingPivot(3,['price'=>30]);
    }

    private function getTotalPriceForEveryOrder($order)
    {
        $orderProducts = $order->products()->where('vendor_id',$this->currentUserVendor()->id)->get();

        $productsAfterSale = $this->getProductsPrice($orderProducts);

        return collect($productsAfterSale)->sum('regular_price');
    }


    private function getProductsPrice($products)
    {
        if (empty($products)) {
            return;
        }

        $productsBox = [];

        foreach ($products as $product) {

            if($product->sale_percent != 0 || $product->sale_percent != null) {

                $productsBox [] = $this->calcSalePrice($product);

            } else{
                $product->pivot->update(['price'=>$product->regular_price]);

                $productsBox [] = $product;
            }
        }

        return $productsBox;
    }

    private function calcSalePrice($product)
    {

        if($product->sale_percent != 0 || $product->sale_percent != null) {

          $newPrice =  $product->regular_price * $product->sale_percent / 100;

           $total = $product->regular_price = ( $product->regular_price - $newPrice);

            $product->pivot->update(['price'=>$total]);

          return $product;
        }

        return $product;
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
        if(!empty($this->error))
        {
          return  $this->error;
        }
    }
}
