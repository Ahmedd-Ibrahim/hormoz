<?php

namespace App\Http\Controllers;

use App\DataTables\CreditDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCreditRequest;
use App\Http\Requests\UpdateCreditRequest;
use App\Repositories\CreditRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class CreditController extends AppBaseController
{
    /** @var  CreditRepository */
    private $creditRepository;

    public function __construct(CreditRepository $creditRepo)
    {
        $this->creditRepository = $creditRepo;
    }

    /**
     * Display a listing of the Credit.
     *
     * @param CreditDataTable $creditDataTable
     * @return Response
     */
    public function index(CreditDataTable $creditDataTable)
    {
        return $creditDataTable->render('admin.credits.index');
    }

    /**
     * Show the form for creating a new Credit.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.credits.create');
    }

    /**
     * Store a newly created Credit in storage.
     *
     * @param CreateCreditRequest $request
     *
     * @return Response
     */
    public function store(CreateCreditRequest $request)
    {
        $input = $request->all();

        $credit = $this->creditRepository->create($input);

        Flash::success('Credit saved successfully.');

        return redirect(route('credits.index'));
    }

    /**
     * Display the specified Credit.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $credit = $this->creditRepository->find($id);

        if (empty($credit)) {
            Flash::error('Credit not found');

            return redirect(route('credits.index'));
        }

        return view('admin.credits.show')->with('credit', $credit);
    }

    /**
     * Show the form for editing the specified Credit.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $credit = $this->creditRepository->find($id);

        if (empty($credit)) {
            Flash::error('Credit not found');

            return redirect(route('credits.index'));
        }

        return view('admin.credits.edit')->with('credit', $credit);
    }

    /**
     * Update the specified Credit in storage.
     *
     * @param  int              $id
     * @param UpdateCreditRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCreditRequest $request)
    {
        $credit = $this->creditRepository->find($id);

        if (empty($credit)) {
            Flash::error('Credit not found');

            return redirect(route('credits.index'));
        }

        $credit = $this->creditRepository->update($request->all(), $id);

        Flash::success('Credit updated successfully.');

        return redirect(route('credits.index'));
    }

    /**
     * Remove the specified Credit from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $credit = $this->creditRepository->find($id);

        if (empty($credit)) {
            Flash::error('Credit not found');

            return redirect(route('credits.index'));
        }

        $this->creditRepository->delete($id);

        Flash::success('Credit deleted successfully.');

        return redirect(route('credits.index'));
    }
}
