<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCreditAPIRequest;
use App\Http\Requests\API\UpdateCreditAPIRequest;
use App\Models\Credit;
use App\Repositories\CreditRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\CreditResource;
use Response;

/**
 * Class CreditController
 * @package App\Http\Controllers\API
 */

class CreditAPIController extends AppBaseController
{
    /** @var  CreditRepository */
    private $creditRepository;

    public function __construct(CreditRepository $creditRepo)
    {
        $this->creditRepository = $creditRepo;
    }

    /**
     * Display a listing of the Credit.
     * GET|HEAD /credits
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $credits = $this->creditRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(CreditResource::collection($credits), 'Credits retrieved successfully');
    }

    /**
     * Store a newly created Credit in storage.
     * POST /credits
     *
     * @param CreateCreditAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCreditAPIRequest $request)
    {
        $input = $request->all();

        $credit = $this->creditRepository->create($input);

        return $this->sendResponse(new CreditResource($credit), 'Credit saved successfully');
    }

    /**
     * Display the specified Credit.
     * GET|HEAD /credits/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Credit $credit */
        $credit = $this->creditRepository->find($id);

        if (empty($credit)) {
            return $this->sendError('Credit not found');
        }

        return $this->sendResponse(new CreditResource($credit), 'Credit retrieved successfully');
    }

    /**
     * Update the specified Credit in storage.
     * PUT/PATCH /credits/{id}
     *
     * @param int $id
     * @param UpdateCreditAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCreditAPIRequest $request)
    {
        $input = $request->all();

        /** @var Credit $credit */
        $credit = $this->creditRepository->find($id);

        if (empty($credit)) {
            return $this->sendError('Credit not found');
        }

        $credit = $this->creditRepository->update($input, $id);

        return $this->sendResponse(new CreditResource($credit), 'Credit updated successfully');
    }

    /**
     * Remove the specified Credit from storage.
     * DELETE /credits/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Credit $credit */
        $credit = $this->creditRepository->find($id);

        if (empty($credit)) {
            return $this->sendError('Credit not found');
        }

        $credit->delete();

        return $this->sendSuccess('Credit deleted successfully');
    }
}
