<?php

namespace App\Http\Controllers;

use App\DataTables\mailingDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatemailingRequest;
use App\Http\Requests\UpdatemailingRequest;
use App\Repositories\mailingRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class mailingController extends AppBaseController
{
    /** @var  mailingRepository */
    private $mailingRepository;

    public function __construct(mailingRepository $mailingRepo)
    {
        $this->mailingRepository = $mailingRepo;
    }

    /**
     * Display a listing of the mailing.
     *
     * @param mailingDataTable $mailingDataTable
     * @return Response
     */
    public function index(mailingDataTable $mailingDataTable)
    {
        return $mailingDataTable->render('admin.mailings.index');
    }

    /**
     * Show the form for creating a new mailing.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.mailings.create');
    }

    /**
     * Store a newly created mailing in storage.
     *
     * @param CreatemailingRequest $request
     *
     * @return Response
     */
    public function store(CreatemailingRequest $request)
    {
        $input = $request->all();

        $mailing = $this->mailingRepository->create($input);

        Flash::success('Mailing saved successfully.');

        return redirect(route('mailings.index'));
    }

    /**
     * Display the specified mailing.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $mailing = $this->mailingRepository->find($id);

        if (empty($mailing)) {
            Flash::error('Mailing not found');

            return redirect(route('mailings.index'));
        }

        return view('admin.mailings.show')->with('mailing', $mailing);
    }

    /**
     * Show the form for editing the specified mailing.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $mailing = $this->mailingRepository->find($id);

        if (empty($mailing)) {
            Flash::error('Mailing not found');

            return redirect(route('mailings.index'));
        }

        return view('admin.mailings.edit')->with('mailing', $mailing);
    }

    /**
     * Update the specified mailing in storage.
     *
     * @param  int              $id
     * @param UpdatemailingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemailingRequest $request)
    {
        $mailing = $this->mailingRepository->find($id);

        if (empty($mailing)) {
            Flash::error('Mailing not found');

            return redirect(route('mailings.index'));
        }

        $mailing = $this->mailingRepository->update($request->all(), $id);

        Flash::success('Mailing updated successfully.');

        return redirect(route('mailings.index'));
    }

    /**
     * Remove the specified mailing from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $mailing = $this->mailingRepository->find($id);

        if (empty($mailing)) {
            Flash::error('Mailing not found');

            return redirect(route('mailings.index'));
        }

        $this->mailingRepository->delete($id);

        Flash::success('Mailing deleted successfully.');

        return redirect(route('mailings.index'));
    }
}
