<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDescuadreRequest;
use App\Http\Requests\UpdateDescuadreRequest;
use App\Repositories\DescuadreRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class DescuadreController extends AppBaseController
{
    /** @var DescuadreRepository $descuadreRepository*/
    private $descuadreRepository;

    public function __construct(DescuadreRepository $descuadreRepo)
    {
        $this->descuadreRepository = $descuadreRepo;
    }

    /**
     * Display a listing of the Descuadre.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $descuadres = $this->descuadreRepository->all();

        return view('descuadres.index')
            ->with('descuadres', $descuadres);
    }

    /**
     * Show the form for creating a new Descuadre.
     *
     * @return Response
     */
    public function create()
    {
        return view('descuadres.create');
    }

    /**
     * Store a newly created Descuadre in storage.
     *
     * @param CreateDescuadreRequest $request
     *
     * @return Response
     */
    public function store(CreateDescuadreRequest $request)
    {
        $input = $request->all();

        $descuadre = $this->descuadreRepository->create($input);

        Flash::success('Descuadre saved successfully.');

        return redirect(route('descuadres.index'));
    }

    /**
     * Display the specified Descuadre.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $descuadre = $this->descuadreRepository->find($id);

        if (empty($descuadre)) {
            Flash::error('Descuadre not found');

            return redirect(route('descuadres.index'));
        }

        return view('descuadres.show')->with('descuadre', $descuadre);
    }

    /**
     * Show the form for editing the specified Descuadre.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $descuadre = $this->descuadreRepository->find($id);

        if (empty($descuadre)) {
            Flash::error('Descuadre not found');

            return redirect(route('descuadres.index'));
        }

        return view('descuadres.edit')->with('descuadre', $descuadre);
    }

    /**
     * Update the specified Descuadre in storage.
     *
     * @param int $id
     * @param UpdateDescuadreRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDescuadreRequest $request)
    {
        $descuadre = $this->descuadreRepository->find($id);

        if (empty($descuadre)) {
            Flash::error('Descuadre not found');

            return redirect(route('descuadres.index'));
        }

        $descuadre = $this->descuadreRepository->update($request->all(), $id);

        Flash::success('Descuadre updated successfully.');

        return redirect(route('descuadres.index'));
    }

    /**
     * Remove the specified Descuadre from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $descuadre = $this->descuadreRepository->find($id);

        if (empty($descuadre)) {
            Flash::error('Descuadre not found');

            return redirect(route('descuadres.index'));
        }

        $this->descuadreRepository->delete($id);

        Flash::success('Descuadre deleted successfully.');

        return redirect(route('descuadres.index'));
    }
}
