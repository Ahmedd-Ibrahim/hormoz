<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateGalleryAPIRequest;
use App\Http\Requests\API\UpdateGalleryAPIRequest;
use App\Models\Gallery;
use App\Repositories\GalleryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\GalleryResource;
use Response;

/**
 * Class GalleryController
 * @package App\Http\Controllers\API
 */

class GalleryAPIController extends AppBaseController
{
    /** @var  GalleryRepository */
    private $galleryRepository;

    public function __construct(GalleryRepository $galleryRepo)
    {
        $this->galleryRepository = $galleryRepo;
    }

    /**
     * Display a listing of the Gallery.
     * GET|HEAD /galleries
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $galleries = $this->galleryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(GalleryResource::collection($galleries), 'Galleries retrieved successfully');
    }

    /**
     * Store a newly created Gallery in storage.
     * POST /galleries
     *
     * @param CreateGalleryAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateGalleryAPIRequest $request)
    {
        $input = $request->all();

        $gallery = $this->galleryRepository->create($input);

        return $this->sendResponse(new GalleryResource($gallery), 'Gallery saved successfully');
    }

    /**
     * Display the specified Gallery.
     * GET|HEAD /galleries/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Gallery $gallery */
        $gallery = $this->galleryRepository->find($id);

        if (empty($gallery)) {
            return $this->sendError('Gallery not found');
        }

        return $this->sendResponse(new GalleryResource($gallery), 'Gallery retrieved successfully');
    }

    /**
     * Update the specified Gallery in storage.
     * PUT/PATCH /galleries/{id}
     *
     * @param int $id
     * @param UpdateGalleryAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGalleryAPIRequest $request)
    {
        $input = $request->all();

        /** @var Gallery $gallery */
        $gallery = $this->galleryRepository->find($id);

        if (empty($gallery)) {
            return $this->sendError('Gallery not found');
        }

        $gallery = $this->galleryRepository->update($input, $id);

        return $this->sendResponse(new GalleryResource($gallery), 'Gallery updated successfully');
    }

    /**
     * Remove the specified Gallery from storage.
     * DELETE /galleries/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Gallery $gallery */
        $gallery = $this->galleryRepository->find($id);

        if (empty($gallery)) {
            return $this->sendError('Gallery not found');
        }

        $gallery->delete();

        return $this->sendSuccess('Gallery deleted successfully');
    }
}
