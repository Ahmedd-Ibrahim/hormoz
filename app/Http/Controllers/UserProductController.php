<?php

namespace App\Http\Controllers;

use App\DataTables\UserProductDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateUserProductRequest;
use App\Http\Requests\UpdateUserProductRequest;
use App\Repositories\UserProductRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class UserProductController extends AppBaseController
{
    /** @var  UserProductRepository */
    private $userProductRepository;

    public function __construct(UserProductRepository $userProductRepo)
    {
        $this->userProductRepository = $userProductRepo;
    }

    /**
     * Display a listing of the UserProduct.
     *
     * @param UserProductDataTable $userProductDataTable
     * @return Response
     */
    public function index(UserProductDataTable $userProductDataTable)
    {
        return $userProductDataTable->render('admin.user_products.index');
    }

    /**
     * Show the form for creating a new UserProduct.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.user_products.create');
    }

    /**
     * Store a newly created UserProduct in storage.
     *
     * @param CreateUserProductRequest $request
     *
     * @return Response
     */
    public function store(CreateUserProductRequest $request)
    {
        $input = $request->all();

        $userProduct = $this->userProductRepository->create($input);

        Flash::success('User Product saved successfully.');

        return redirect(route('userProducts.index'));
    }

    /**
     * Display the specified UserProduct.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userProduct = $this->userProductRepository->find($id);

        if (empty($userProduct)) {
            Flash::error('User Product not found');

            return redirect(route('userProducts.index'));
        }

        return view('admin.user_products.show')->with('userProduct', $userProduct);
    }

    /**
     * Show the form for editing the specified UserProduct.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userProduct = $this->userProductRepository->find($id);

        if (empty($userProduct)) {
            Flash::error('User Product not found');

            return redirect(route('userProducts.index'));
        }

        return view('admin.user_products.edit')->with('userProduct', $userProduct);
    }

    /**
     * Update the specified UserProduct in storage.
     *
     * @param  int              $id
     * @param UpdateUserProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserProductRequest $request)
    {
        $userProduct = $this->userProductRepository->find($id);

        if (empty($userProduct)) {
            Flash::error('User Product not found');

            return redirect(route('userProducts.index'));
        }

        $userProduct = $this->userProductRepository->update($request->all(), $id);

        Flash::success('User Product updated successfully.');

        return redirect(route('userProducts.index'));
    }

    /**
     * Remove the specified UserProduct from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userProduct = $this->userProductRepository->find($id);

        if (empty($userProduct)) {
            Flash::error('User Product not found');

            return redirect(route('userProducts.index'));
        }

        $this->userProductRepository->delete($id);

        Flash::success('User Product deleted successfully.');

        return redirect(route('userProducts.index'));
    }
}
