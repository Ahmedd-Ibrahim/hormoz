<?php

namespace App\Http\Controllers;

use App\DataTables\SubCategoryDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use App\Repositories\SubCategoryRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class SubCategoryController extends AppBaseController
{
    /** @var  SubCategoryRepository */
    private $subCategoryRepository;

    public function __construct(SubCategoryRepository $subCategoryRepo)
    {
        $this->subCategoryRepository = $subCategoryRepo;
    }

    /**
     * Display a listing of the SubCategory.
     *
     * @param SubCategoryDataTable $subCategoryDataTable
     * @return Response
     */
    public function index(SubCategoryDataTable $subCategoryDataTable)
    {
        return $subCategoryDataTable->render('admin.sub_categories.index');
    }

    /**
     * Show the form for creating a new SubCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.sub_categories.create');
    }

    /**
     * Store a newly created SubCategory in storage.
     *
     * @param CreateSubCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateSubCategoryRequest $request)
    {
        $input = $request->all();

        $subCategory = $this->subCategoryRepository->create($input);

        Flash::success('Sub Category saved successfully.');

        return redirect(route('subCategories.index'));
    }

    /**
     * Display the specified SubCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $subCategory = $this->subCategoryRepository->find($id);

        if (empty($subCategory)) {
            Flash::error('Sub Category not found');

            return redirect(route('subCategories.index'));
        }

        return view('admin.sub_categories.show')->with('subCategory', $subCategory);
    }

    /**
     * Show the form for editing the specified SubCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $subCategory = $this->subCategoryRepository->find($id);

        if (empty($subCategory)) {
            Flash::error('Sub Category not found');

            return redirect(route('subCategories.index'));
        }

        return view('admin.sub_categories.edit')->with('subCategory', $subCategory);
    }

    /**
     * Update the specified SubCategory in storage.
     *
     * @param  int              $id
     * @param UpdateSubCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSubCategoryRequest $request)
    {
        $subCategory = $this->subCategoryRepository->find($id);

        if (empty($subCategory)) {
            Flash::error('Sub Category not found');

            return redirect(route('subCategories.index'));
        }

        $subCategory = $this->subCategoryRepository->update($request->all(), $id);

        Flash::success('Sub Category updated successfully.');

        return redirect(route('subCategories.index'));
    }

    /**
     * Remove the specified SubCategory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $subCategory = $this->subCategoryRepository->find($id);

        if (empty($subCategory)) {
            Flash::error('Sub Category not found');

            return redirect(route('subCategories.index'));
        }

        $this->subCategoryRepository->delete($id);

        Flash::success('Sub Category deleted successfully.');

        return redirect(route('subCategories.index'));
    }
}
