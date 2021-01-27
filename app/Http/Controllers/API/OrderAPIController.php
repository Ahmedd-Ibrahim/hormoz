<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrderAPIRequest;
use App\Http\Requests\API\UpdateOrderAPIRequest;
use App\Http\Resources\OrderCountResource;
use App\Http\Resources\singleOrderProductsResource;
use App\Http\Resources\singleOrderResource;
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

    public function singleOrder($id)
    {
        $order = $this->orderRepository->getSingleOrderById($id);

        if(empty($order)) {
            return $this->sendError('order is Empty');
        }elseif (!empty($this->orderRepository->error)) {
            return $this->sendError($this->orderRepository->error);
        }
        return $this->sendResponse(new singleOrderResource($order),'order retrieved successfully');

    }

    public function getSingleOrderProducts($id)
    {
        $order = $this->orderRepository->getSingleOrderById($id);

        $products = $this->orderRepository->getSingleOrderProducts($order);

        if(empty($order) || empty($products)) {

            return $this->sendError('order is Empty');

        }elseif (!empty($this->orderRepository->error)) {

            return $this->sendError($this->orderRepository->error);
        }

        return $this->sendResponse(singleOrderProductsResource::collection($products),'order retrieved successfully');
    }


    public function vendorOrdersHistory()
    {
        $history = $this->orderRepository->vendorOrderHistory();

        if(empty($history)) {

            return $this->sendError('No orders Yet');

        }elseif (!empty($this->orderRepository->error)) {

            return $this->sendError($this->orderRepository->error);
        }

        return $this->sendResponse($history,'orders retrieved successfully');
    }

    public function home()
    {
        $name = $this->orderRepository->userName();

        $totalOrders = $this->orderRepository->getVendorOrdersTotalCount();

        $totalProductsCount = $this->orderRepository->totalProductsCountFromCompletedOrders();

        if(empty($name)) {

            return $this->sendError('Need to login');

        }elseif (!empty($this->orderRepository->error)) {

            return $this->sendError($this->orderRepository->error);
        }

        $data = [
            'username' => $name,
            'totalOrders' => $totalOrders,
            'productsSolid' => $totalProductsCount
        ];

        return $this->sendResponse($data,'orders retrieved successfully');
    }

    public function homeWainingOrders()
    {
        $orders = $this->orderRepository->WainingOrders();

        if(empty($orders) || $orders->count() < 1 ) {

            return $this->sendError('No Orders Yet');

        }elseif (!empty($this->orderRepository->error)) {

            return $this->sendError($this->orderRepository->error);
        }

        return $this->sendResponse(OrderResource::collection($orders),'orders retrieved successfully');
    }

    public function fastInfo()
    {
        $newOrders =  $this->orderRepository->newOrders();

        $waitingOrdersCount =  $this->orderRepository->WainingOrders();

        $waitingCount = $waitingOrdersCount->count();

        $preparing = $this->orderRepository->getVendorOrderPreparingCount();

        $productsWillOutOfStuck = $this->orderRepository->ProductsWillOutOfStock();

        $productsOutOfStock = $this->orderRepository->ProductsOutOfStock();


        if(!empty($this->orderRepository->error)) {

            return $this->sendError($this->orderRepository->error);
        }

        $data = [

            'new orders ' => $newOrders,

            'waiting ' => $waitingCount,

            'preparing ' => $preparing,

            'productsWillOutOfStuck ' => $productsWillOutOfStuck,

            'productsOutOfStock ' => $productsOutOfStock,


        ];

        return $this->sendResponse($data,'orders retrieved successfully');

    }

}
