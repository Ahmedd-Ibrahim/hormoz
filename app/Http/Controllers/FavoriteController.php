<?php

namespace App\Http\Controllers;

use App\DataTables\FavoriteDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use App\Repositories\FavoriteRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class FavoriteController extends AppBaseController
{
    /** @var  FavoriteRepository */
    private $favoriteRepository;

    public function __construct(FavoriteRepository $favoriteRepo)
    {
        $this->favoriteRepository = $favoriteRepo;
    }

    /**
     * Display a listing of the Favorite.
     *
     * @param FavoriteDataTable $favoriteDataTable
     * @return Response
     */
    public function index(FavoriteDataTable $favoriteDataTable)
    {
        return $favoriteDataTable->render('admin.favorites.index');
    }

    /**
     * Show the form for creating a new Favorite.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.favorites.create');
    }

    /**
     * Store a newly created Favorite in storage.
     *
     * @param CreateFavoriteRequest $request
     *
     * @return Response
     */
    public function store(CreateFavoriteRequest $request)
    {
        $input = $request->all();

        $favorite = $this->favoriteRepository->create($input);

        Flash::success('Favorite saved successfully.');

        return redirect(route('favorites.index'));
    }

    /**
     * Display the specified Favorite.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $favorite = $this->favoriteRepository->find($id);

        if (empty($favorite)) {
            Flash::error('Favorite not found');

            return redirect(route('favorites.index'));
        }

        return view('admin.favorites.show')->with('favorite', $favorite);
    }

    /**
     * Show the form for editing the specified Favorite.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $favorite = $this->favoriteRepository->find($id);

        if (empty($favorite)) {
            Flash::error('Favorite not found');

            return redirect(route('favorites.index'));
        }

        return view('admin.favorites.edit')->with('favorite', $favorite);
    }

    /**
     * Update the specified Favorite in storage.
     *
     * @param  int              $id
     * @param UpdateFavoriteRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFavoriteRequest $request)
    {
        $favorite = $this->favoriteRepository->find($id);

        if (empty($favorite)) {
            Flash::error('Favorite not found');

            return redirect(route('favorites.index'));
        }

        $favorite = $this->favoriteRepository->update($request->all(), $id);

        Flash::success('Favorite updated successfully.');

        return redirect(route('favorites.index'));
    }

    /**
     * Remove the specified Favorite from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $favorite = $this->favoriteRepository->find($id);

        if (empty($favorite)) {
            Flash::error('Favorite not found');

            return redirect(route('favorites.index'));
        }

        $this->favoriteRepository->delete($id);

        Flash::success('Favorite deleted successfully.');

        return redirect(route('favorites.index'));
    }
}
