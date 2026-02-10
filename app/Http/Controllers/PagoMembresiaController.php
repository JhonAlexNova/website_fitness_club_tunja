<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePagoMembresiaRequest;
use App\Http\Requests\UpdatePagoMembresiaRequest;
use App\Repositories\PagoMembresiaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PagoMembresiaController extends AppBaseController
{
    /** @var PagoMembresiaRepository $pagoMembresiaRepository*/
    private $pagoMembresiaRepository;

    public function __construct(PagoMembresiaRepository $pagoMembresiaRepo)
    {
        $this->pagoMembresiaRepository = $pagoMembresiaRepo;
    }

    /**
     * Display a listing of the PagoMembresia.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $pagoMembresias = $this->pagoMembresiaRepository->all();

        return view('pago_membresias.index')
            ->with('pagoMembresias', $pagoMembresias);
    }

    /**
     * Show the form for creating a new PagoMembresia.
     *
     * @return Response
     */
    public function create()
    {
        return view('pago_membresias.create');
    }

    /**
     * Store a newly created PagoMembresia in storage.
     *
     * @param CreatePagoMembresiaRequest $request
     *
     * @return Response
     */
    public function store(CreatePagoMembresiaRequest $request)
    {
        $input = $request->all();

        $pagoMembresia = $this->pagoMembresiaRepository->create($input);

        Flash::success('Pago Membresia saved successfully.');

        return redirect(route('pagoMembresias.index'));
    }

    /**
     * Display the specified PagoMembresia.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pagoMembresia = $this->pagoMembresiaRepository->find($id);

        if (empty($pagoMembresia)) {
            Flash::error('Pago Membresia not found');

            return redirect(route('pagoMembresias.index'));
        }

        return view('pago_membresias.show')->with('pagoMembresia', $pagoMembresia);
    }

    /**
     * Show the form for editing the specified PagoMembresia.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pagoMembresia = $this->pagoMembresiaRepository->find($id);

        if (empty($pagoMembresia)) {
            Flash::error('Pago Membresia not found');

            return redirect(route('pagoMembresias.index'));
        }

        return view('pago_membresias.edit')->with('pagoMembresia', $pagoMembresia);
    }

    /**
     * Update the specified PagoMembresia in storage.
     *
     * @param int $id
     * @param UpdatePagoMembresiaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePagoMembresiaRequest $request)
    {
        $pagoMembresia = $this->pagoMembresiaRepository->find($id);

        if (empty($pagoMembresia)) {
            Flash::error('Pago Membresia not found');

            return redirect(route('pagoMembresias.index'));
        }

        $pagoMembresia = $this->pagoMembresiaRepository->update($request->all(), $id);

        Flash::success('Pago Membresia updated successfully.');

        return redirect(route('pagoMembresias.index'));
    }

    /**
     * Remove the specified PagoMembresia from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pagoMembresia = $this->pagoMembresiaRepository->find($id);

        if (empty($pagoMembresia)) {
            Flash::error('Pago Membresia not found');

            return redirect(route('pagoMembresias.index'));
        }

        $this->pagoMembresiaRepository->delete($id);

        Flash::success('Pago Membresia deleted successfully.');

        return redirect(route('pagoMembresias.index'));
    }
}
