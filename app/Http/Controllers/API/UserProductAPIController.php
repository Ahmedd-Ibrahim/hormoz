<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserProductAPIRequest;
use App\Http\Requests\API\UpdateUserProductAPIRequest;
use App\Models\UserProduct;
use App\Repositories\UserProductRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\UserProductResource;
use Response;

/**
 * Class UserProductController
 * @package App\Http\Controllers\API
 */

class UserProductAPIController extends AppBaseController
{
    /** @var  UserProductRepository */
    private $userProductRepository;

    public function __construct(UserProductRepository $userProductRepo)
    {
        $this->userProductRepository = $userProductRepo;
    }

    /**
     * Display a listing of the UserProduct.
     * GET|HEAD /userProducts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $userProducts = $this->userProductRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(UserProductResource::collection($userProducts), 'User Products retrieved successfully');
    }

    /**
     * Store a newly created UserProduct in storage.
     * POST /userProducts
     *
     * @param CreateUserProductAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateUserProductAPIRequest $request)
    {
        $input = $request->all();

        $userProduct = $this->userProductRepository->create($input);

        return $this->sendResponse(new UserProductResource($userProduct), 'User Product saved successfully');
    }

    /**
     * Display the specified UserProduct.
     * GET|HEAD /userProducts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var UserProduct $userProduct */
        $userProduct = $this->userProductRepository->find($id);

        if (empty($userProduct)) {
            return $this->sendError('User Product not found');
        }

        return $this->sendResponse(new UserProductResource($userProduct), 'User Product retrieved successfully');
    }

    /**
     * Update the specified UserProduct in storage.
     * PUT/PATCH /userProducts/{id}
     *
     * @param int $id
     * @param UpdateUserProductAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserProductAPIRequest $request)
    {
        $input = $request->all();

        /** @var UserProduct $userProduct */
        $userProduct = $this->userProductRepository->find($id);

        if (empty($userProduct)) {
            return $this->sendError('User Product not found');
        }

        $userProduct = $this->userProductRepository->update($input, $id);

        return $this->sendResponse(new UserProductResource($userProduct), 'UserProduct updated successfully');
    }

    /**
     * Remove the specified UserProduct from storage.
     * DELETE /userProducts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var UserProduct $userProduct */
        $userProduct = $this->userProductRepository->find($id);

        if (empty($userProduct)) {
            return $this->sendError('User Product not found');
        }

        $userProduct->delete();

        return $this->sendSuccess('User Product deleted successfully');
    }
}
