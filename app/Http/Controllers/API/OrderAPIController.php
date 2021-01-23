<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrderAPIRequest;
use App\Http\Requests\API\UpdateOrderAPIRequest;
use App\Http\Resources\OrderCountResource;
use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\OrderResource;
//use Matrix\Builder;
use Response;

/**
 * Class OrderController
 * @package App\Http\Controllers\API
 */

class OrderAPIController extends AppBaseController
{
    /** @var  OrderRepository */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
    }

    /**
     * Display a listing of the Order.
     * GET|HEAD /orders
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $orders = $this->orderRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(OrderResource::collection($orders), 'Orders retrieved successfully');
    }

    /**
     * Store a newly created Order in storage.
     * POST /orders
     *
     * @param CreateOrderAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderAPIRequest $request)
    {
        $input = $request->all();

        $order = $this->orderRepository->create($input);

        return $this->sendResponse(new OrderResource($order), 'Order saved successfully');
    }

    /**
     * Display the specified Order.
     * GET|HEAD /orders/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Order $order */
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            return $this->sendError('Order not found');
        }

        return $this->sendResponse(new OrderResource($order), 'Order retrieved successfully');
    }

    /**
     * Update the specified Order in storage.
     * PUT/PATCH /orders/{id}
     *
     * @param int $id
     * @param UpdateOrderAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderAPIRequest $request)
    {
        $input = $request->all();

        /** @var Order $order */
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            return $this->sendError('Order not found');
        }

        $order = $this->orderRepository->update($input, $id);

        return $this->sendResponse(new OrderResource($order), 'Order updated successfully');
    }

    /**
     * Remove the specified Order from storage.
     * DELETE /orders/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Order $order */
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            return $this->sendError('Order not found');
        }

        $order->delete();

        return $this->sendSuccess('Order deleted successfully');
    }

    public function count()
    {
        $data['total'] =  $this->orderRepository->getVendorOrdersTotalCount();

        $data['waiting'] = $this->orderRepository->getVendorOrdersWaitingCount();

        $data['preparing'] = $this->orderRepository->getVendorOrderPreparingCount();

        $data['waiting_delivery'] =  $this->orderRepository->getVendorOrderWaitDeliveryCount();

        $data['on_delivery'] = $this->orderRepository->getVendorOrderOnDeliveringCount();

        $data['completed'] =  $this->orderRepository->getVendorOrderComplectedCount();

        $data['canceled'] =  $this->orderRepository->getVendorOrderCanceledCount();

        if(!empty($this->orderRepository->error)) {
            return $this->sendError($this->orderRepository->error);
        }

        return $this->sendResponse($data,'counts retrieved successfully');

    }

    public function history()
    {
        $history = $this->orderRepository->vendorOrderHistory();

        if(empty($history)) {

            return $this->sendError('No orders Yet');

        }elseif (!empty($this->orderRepository->error)) {

            return $this->sendError($this->orderRepository->error);
        }

        return $this->sendResponse($history,'orders retrieved successfully');
    }

    public function products()
    {
        return $this->orderRepository->test();
    }
}
