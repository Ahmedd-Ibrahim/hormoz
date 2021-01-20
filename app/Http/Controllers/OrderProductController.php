<?php

namespace App\Http\Controllers;

use App\DataTables\OrderProductDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOrderProductRequest;
use App\Http\Requests\UpdateOrderProductRequest;
use App\Repositories\OrderProductRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class OrderProductController extends AppBaseController
{
    /** @var  OrderProductRepository */
    private $orderProductRepository;

    public function __construct(OrderProductRepository $orderProductRepo)
    {
        $this->orderProductRepository = $orderProductRepo;
    }

    /**
     * Display a listing of the OrderProduct.
     *
     * @param OrderProductDataTable $orderProductDataTable
     * @return Response
     */
    public function index(OrderProductDataTable $orderProductDataTable)
    {
        return $orderProductDataTable->render('admin.order_products.index');
    }

    /**
     * Show the form for creating a new OrderProduct.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.order_products.create');
    }

    /**
     * Store a newly created OrderProduct in storage.
     *
     * @param CreateOrderProductRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderProductRequest $request)
    {
        $input = $request->all();

        $orderProduct = $this->orderProductRepository->create($input);

        Flash::success('Order Product saved successfully.');

        return redirect(route('orderProducts.index'));
    }

    /**
     * Display the specified OrderProduct.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orderProduct = $this->orderProductRepository->find($id);

        if (empty($orderProduct)) {
            Flash::error('Order Product not found');

            return redirect(route('orderProducts.index'));
        }

        return view('admin.order_products.show')->with('orderProduct', $orderProduct);
    }

    /**
     * Show the form for editing the specified OrderProduct.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $orderProduct = $this->orderProductRepository->find($id);

        if (empty($orderProduct)) {
            Flash::error('Order Product not found');

            return redirect(route('orderProducts.index'));
        }

        return view('admin.order_products.edit')->with('orderProduct', $orderProduct);
    }

    /**
     * Update the specified OrderProduct in storage.
     *
     * @param  int              $id
     * @param UpdateOrderProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderProductRequest $request)
    {
        $orderProduct = $this->orderProductRepository->find($id);

        if (empty($orderProduct)) {
            Flash::error('Order Product not found');

            return redirect(route('orderProducts.index'));
        }

        $orderProduct = $this->orderProductRepository->update($request->all(), $id);

        Flash::success('Order Product updated successfully.');

        return redirect(route('orderProducts.index'));
    }

    /**
     * Remove the specified OrderProduct from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orderProduct = $this->orderProductRepository->find($id);

        if (empty($orderProduct)) {
            Flash::error('Order Product not found');

            return redirect(route('orderProducts.index'));
        }

        $this->orderProductRepository->delete($id);

        Flash::success('Order Product deleted successfully.');

        return redirect(route('orderProducts.index'));
    }
}
