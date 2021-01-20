<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrderProductAPIRequest;
use App\Http\Requests\API\UpdateOrderProductAPIRequest;
use App\Models\OrderProduct;
use App\Repositories\OrderProductRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\OrderProductResource;
use Response;

/**
 * Class OrderProductController
 * @package App\Http\Controllers\API
 */

class OrderProductAPIController extends AppBaseController
{
    /** @var  OrderProductRepository */
    private $orderProductRepository;

    public function __construct(OrderProductRepository $orderProductRepo)
    {
        $this->orderProductRepository = $orderProductRepo;
    }

    /**
     * Display a listing of the OrderProduct.
     * GET|HEAD /orderProducts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $orderProducts = $this->orderProductRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(OrderProductResource::collection($orderProducts), 'Order Products retrieved successfully');
    }

    /**
     * Store a newly created OrderProduct in storage.
     * POST /orderProducts
     *
     * @param CreateOrderProductAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderProductAPIRequest $request)
    {
        $input = $request->all();

        $orderProduct = $this->orderProductRepository->create($input);

        return $this->sendResponse(new OrderProductResource($orderProduct), 'Order Product saved successfully');
    }

    /**
     * Display the specified OrderProduct.
     * GET|HEAD /orderProducts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var OrderProduct $orderProduct */
        $orderProduct = $this->orderProductRepository->find($id);

        if (empty($orderProduct)) {
            return $this->sendError('Order Product not found');
        }

        return $this->sendResponse(new OrderProductResource($orderProduct), 'Order Product retrieved successfully');
    }

    /**
     * Update the specified OrderProduct in storage.
     * PUT/PATCH /orderProducts/{id}
     *
     * @param int $id
     * @param UpdateOrderProductAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderProductAPIRequest $request)
    {
        $input = $request->all();

        /** @var OrderProduct $orderProduct */
        $orderProduct = $this->orderProductRepository->find($id);

        if (empty($orderProduct)) {
            return $this->sendError('Order Product not found');
        }

        $orderProduct = $this->orderProductRepository->update($input, $id);

        return $this->sendResponse(new OrderProductResource($orderProduct), 'OrderProduct updated successfully');
    }

    /**
     * Remove the specified OrderProduct from storage.
     * DELETE /orderProducts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var OrderProduct $orderProduct */
        $orderProduct = $this->orderProductRepository->find($id);

        if (empty($orderProduct)) {
            return $this->sendError('Order Product not found');
        }

        $orderProduct->delete();

        return $this->sendSuccess('Order Product deleted successfully');
    }
}
