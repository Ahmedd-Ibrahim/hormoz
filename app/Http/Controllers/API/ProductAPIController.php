<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductAPIRequest;
use App\Http\Requests\API\UpdateProductAPIRequest;
use App\Http\Resources\homeProductsResource;
use App\Http\Resources\VendorProductsResource;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ProductResource;
use Illuminate\Database\Eloquent\Builder;
use Response;

/**
 * Class ProductController
 * @package App\Http\Controllers\API
 */

class ProductAPIController extends AppBaseController
{
    /** @var  ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepository = $productRepo;
    }

    /**
     * Display a listing of the Product.
     * GET|HEAD /products
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $products = $this->productRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ProductResource::collection($products), 'Products retrieved successfully');
    }

    /**
     * Store a newly created Product in storage.
     * POST /products
     *
     * @param CreateProductAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProductAPIRequest $request)
    {
        $input = $request->all();

        $product = $this->productRepository->create($input);

        return $this->sendResponse(new ProductResource($product), 'Product saved successfully');
    }

    /**
     * Display the specified Product.
     * GET|HEAD /products/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Product $product */
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            return $this->sendError('Product not found');
        }

        return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully');
    }

    /**
     * Update the specified Product in storage.
     * PUT/PATCH /products/{id}
     *
     * @param int $id
     * @param UpdateProductAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductAPIRequest $request)
    {
        $input = $request->all();

        /** @var Product $product */
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            return $this->sendError('Product not found');
        }

        $product = $this->productRepository->update($input, $id);

        return $this->sendResponse(new ProductResource($product), 'Product updated successfully');
    }

    /**
     * Remove the specified Product from storage.
     * DELETE /products/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Product $product */
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            return $this->sendError('Product not found');
        }

        $product->delete();

        return $this->sendSuccess('Product deleted successfully');
    }


    public function allProducts()
    {
        $products = $this->productRepository->getAllProductsForCurrentVendor();

        if(empty($products)) {

            return $this->sendError('No Products Yet');

        } elseif (!empty($this->productRepository->error)) {

            return $this->sendError($this->productRepository->error);
        }

        return  $this->sendResponse(VendorProductsResource::collection($products),'Product retrieved successfully');
    }

    public function simCards()
    {
        $simProducts = Product::whereHas('category',function (Builder $q){
            $q->where('name','like','%sim%')->where('status','active');
        })->select('id','name','regular_price')->paginate(10);

        if(empty($simProducts) || $simProducts->count() < 1) {

            return $this->sendError('No products on this category Yet');
        }

        return  $this->sendResponse($simProducts,'Product retrieved successfully');
    }



    public function card()
    {
        $simProducts = Product::whereHas('category',function (Builder $q){
            $q->where('name','like','%card%')->where('status','active');
        })->select('id','name','regular_price')->paginate(10);

        if(empty($simProducts) || $simProducts->count() < 1) {

            return $this->sendError('No products on this category Yet');
        }

        return  $this->sendResponse($simProducts,'Product retrieved successfully');
    }

    public function elect()
    {
        $simProducts = Product::whereHas('category',function (Builder $q){
            $q->where('name','like','%elect%')->where('status','active');
        })->select('id','name','regular_price')->paginate(10);

        if(empty($simProducts) || $simProducts->count() < 1) {

            return $this->sendError('No products on this category Yet');
        }

        return  $this->sendResponse($simProducts,'Product retrieved successfully');
    }


    public function pc()
    {
        $simProducts = Product::whereHas('category',function (Builder $q){
            $q->where('name','like','%computer%')->where('status','active');
        })->select('id','name','regular_price')->paginate(10);

        if(empty($simProducts) || $simProducts->count() < 1) {

            return $this->sendError('No products on this category Yet');
        }

        return  $this->sendResponse($simProducts,'Product retrieved successfully');
    }


    public function slide()
    {
        $simProducts = Product::where('slide','true')->select('id','name','catching_word','regular_price')->paginate(3);

        if(empty($simProducts) || $simProducts->count() < 1) {

            return $this->sendError('No products on this category Yet');
        }

        return  $this->sendResponse($simProducts,'Product retrieved successfully');
    }
}
