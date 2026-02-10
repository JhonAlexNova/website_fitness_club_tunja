<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSedeRequest;
use App\Http\Requests\UpdateSedeRequest;
use App\Repositories\SedeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SedeController extends AppBaseController
{
    /** @var SedeRepository $sedeRepository*/
    private $sedeRepository;

    public function __construct(SedeRepository $sedeRepo)
    {
        $this->sedeRepository = $sedeRepo;
    }

    /**
     * Display a listing of the Sede.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $sedes = $this->sedeRepository->all();

        return view('sedes.index')
            ->with('sedes', $sedes);
    }

    /**
     * Show the form for creating a new Sede.
     *
     * @return Response
     */
    public function create()
    {
        return view('sedes.create');
    }

    /**
     * Store a newly created Sede in storage.
     *
     * @param CreateSedeRequest $request
     *
     * @return Response
     */
    public function store(CreateSedeRequest $request)
    {
        $input = $request->all();

        $sede = $this->sedeRepository->create($input);

        Flash::success('Sede saved successfully.');

        return redirect(route('sedes.index'));
    }

    /**
     * Display the specified Sede.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sede = $this->sedeRepository->find($id);

        if (empty($sede)) {
            Flash::error('Sede not found');

            return redirect(route('sedes.index'));
        }

        return view('sedes.show')->with('sede', $sede);
    }

    /**
     * Show the form for editing the specified Sede.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sede = $this->sedeRepository->find($id);

        if (empty($sede)) {
            Flash::error('Sede not found');

            return redirect(route('sedes.index'));
        }

        return view('sedes.edit')->with('sede', $sede);
    }

    /**
     * Update the specified Sede in storage.
     *
     * @param int $id
     * @param UpdateSedeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSedeRequest $request)
    {
        $sede = $this->sedeRepository->find($id);

        if (empty($sede)) {
            Flash::error('Sede not found');

            return redirect(route('sedes.index'));
        }

        $sede = $this->sedeRepository->update($request->all(), $id);

        Flash::success('Sede updated successfully.');

        return redirect(route('sedes.index'));
    }

    /**
     * Remove the specified Sede from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sede = $this->sedeRepository->find($id);

        if (empty($sede)) {
            Flash::error('Sede not found');

            return redirect(route('sedes.index'));
        }

        $this->sedeRepository->delete($id);

        Flash::success('Sede deleted successfully.');

        return redirect(route('sedes.index'));
    }
}
