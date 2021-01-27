<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatemailingAPIRequest;
use App\Http\Requests\API\UpdatemailingAPIRequest;
use App\Models\mailing;
use App\Repositories\mailingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\mailingResource;
use Response;

/**
 * Class mailingController
 * @package App\Http\Controllers\API
 */

class mailingAPIController extends AppBaseController
{
    /** @var  mailingRepository */
    private $mailingRepository;

    public function __construct(mailingRepository $mailingRepo)
    {
        $this->mailingRepository = $mailingRepo;
    }

    /**
     * Display a listing of the mailing.
     * GET|HEAD /mailings
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $mailings = $this->mailingRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(mailingResource::collection($mailings), 'Mailings retrieved successfully');
    }

    /**
     * Store a newly created mailing in storage.
     * POST /mailings
     *
     * @param CreatemailingAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatemailingAPIRequest $request)
    {
        $input = $request->all();

        $mailing = $this->mailingRepository->create($input);

        return $this->sendResponse(new mailingResource($mailing), 'Mailing saved successfully');
    }

    /**
     * Display the specified mailing.
     * GET|HEAD /mailings/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var mailing $mailing */
        $mailing = $this->mailingRepository->find($id);

        if (empty($mailing)) {
            return $this->sendError('Mailing not found');
        }

        return $this->sendResponse(new mailingResource($mailing), 'Mailing retrieved successfully');
    }

    /**
     * Update the specified mailing in storage.
     * PUT/PATCH /mailings/{id}
     *
     * @param int $id
     * @param UpdatemailingAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemailingAPIRequest $request)
    {
        $input = $request->all();

        /** @var mailing $mailing */
        $mailing = $this->mailingRepository->find($id);

        if (empty($mailing)) {
            return $this->sendError('Mailing not found');
        }

        $mailing = $this->mailingRepository->update($input, $id);

        return $this->sendResponse(new mailingResource($mailing), 'mailing updated successfully');
    }

    /**
     * Remove the specified mailing from storage.
     * DELETE /mailings/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var mailing $mailing */
        $mailing = $this->mailingRepository->find($id);

        if (empty($mailing)) {
            return $this->sendError('Mailing not found');
        }

        $mailing->delete();

        return $this->sendSuccess('Mailing deleted successfully');
    }
}
