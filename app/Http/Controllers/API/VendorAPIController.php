<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateVendorAPIRequest;
use App\Http\Requests\API\UpdateVendorAPIRequest;
use App\Http\Requests\BankRequest;
use App\Models\Vendor;
use App\Repositories\VendorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\VendorResource;
use Illuminate\Support\Facades\Auth;
use Response;
use Tymon\JWTAuth\JWTAuth;


/**
 * Class VendorController
 * @package App\Http\Controllers\API
 */

class VendorAPIController extends AppBaseController
{
    /** @var  VendorRepository */
    private $vendorRepository;

    public function __construct(VendorRepository $vendorRepo)
    {
        $this->vendorRepository = $vendorRepo;
    }

    /**
     * Display a listing of the Vendor.
     * GET|HEAD /vendors
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $vendors = $this->vendorRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(VendorResource::collection($vendors), 'Vendors retrieved successfully');
    }

    /**
     * Store a newly created Vendor in storage.
     * POST /vendors
     *
     * @param CreateVendorAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateVendorAPIRequest $request)
    {
        $input = $request->all();

        $vendor = $this->vendorRepository->create($input);

      if (!empty($this->vendorRepository->errors)) {
         return $this->sendError($this->vendorRepository->errors);

      }
        return $this->sendResponse($vendor, 'Vendor saved successfully');
    }

    /**
     * Display the specified Vendor.
     * GET|HEAD /vendors/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Vendor $vendor */
        $vendor = $this->vendorRepository->find($id);

        if (empty($vendor)) {
            return $this->sendError('Vendor not found');
        }

        return $this->sendResponse(new VendorResource($vendor), 'Vendor retrieved successfully');
    }

    /**
     * Update the specified Vendor in storage.
     * PUT/PATCH /vendors/{id}
     *
     * @param int $id
     * @param UpdateVendorAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVendorAPIRequest $request)
    {
        $input = $request->all();

        /** @var Vendor $vendor */
        $vendor = $this->vendorRepository->find($id);

        if (empty($vendor)) {
            return $this->sendError('Vendor not found');
        }

        $vendor = $this->vendorRepository->update($input, $id);

        return $this->sendResponse(new VendorResource($vendor), 'Vendor updated successfully');
    }

    /**
     * Remove the specified Vendor from storage.
     * DELETE /vendors/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Vendor $vendor */
        $vendor = $this->vendorRepository->find($id);

        if (empty($vendor)) {
            return $this->sendError('Vendor not found');
        }

        $vendor->delete();

        return $this->sendSuccess('Vendor deleted successfully');
    }

    public function uploadLegal(Request $request)
    {
        $input = $request->all();

        $this->vendorRepository->legal($input);

        if(!empty($this->vendorRepository->errors)) {

            return $this->sendError($this->vendorRepository->errors);
        }
        return $this->sendSuccess('Vendor legal uploaded successfully');
    }


    public function bank(BankRequest $request)
    {
        $input = $request->all();

        $this->vendorRepository->UpdateUserBank($input);

        if(!empty($this->vendorRepository->errors)) {

            return $this->sendError($this->vendorRepository->errors);
        }

        return $this->sendSuccess('bank added successfully');
    }
}
