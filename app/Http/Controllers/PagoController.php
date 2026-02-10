<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePagoRequest;
use App\Http\Requests\UpdatePagoRequest;
use App\Repositories\PagoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\Pago;
use App\Models\MetodoPago;
use App\Models\Cierre;

use App\Repositories\CierreDiaRepository;

class PagoController extends AppBaseController
{
    /** @var PagoRepository $pagoRepository*/
    private $pagoRepository;
    private $cierreDiaRepository;

    public function __construct(
        PagoRepository $pagoRepo,
        CierreDiaRepository $cierreDiaRepo
    )
    {
        $this->pagoRepository = $pagoRepo;
        $this->cierreDiaRepository = $cierreDiaRepo;
    }

    /**
     * Display a listing of the Pago.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $pagos = $this->pagoRepository->withRelations();

        return view('pagos.index')
            ->with('pagos', $pagos);
    }

    /**
     * Show the form for creating a new Pago.
     *
     * @return Response
     */
    public function create()
    {
        $metodos = MetodoPago::get();
        $backpack = [
            'metodos' => $metodos
        ];

        //dd($backpack);
        return view('pagos.create',$backpack);
    }

    /**
     * Store a newly created Pago in storage.
     *
     * @param CreatePagoRequest $request
     *
     * @return Response
     */
    public function store(CreatePagoRequest $request)
    {
        $input = $request->all();
        $cierre =  $this->cierreDiaRepository->validar_dia();

        $input['cierre_id'] = $cierre->id;
        $input['valor'] = str_replace(array(',','.'),'',$request->valor);

        $pago = $this->pagoRepository->create($input);

        Flash::success('Pago saved successfully.');

        return redirect(route('pagos.index'));
    }

    /**
     * Display the specified Pago.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pago = $this->pagoRepository->find($id);


        

        if (empty($pago)) {
            Flash::error('Pago not found');

            return redirect(route('pagos.index'));
        }

        return view('pagos.show')->with('pago', $pago);
    }

    /**
     * Show the form for editing the specified Pago.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pago = $this->pagoRepository->find($id);

        if (empty($pago)) {
            Flash::error('Pago not found');

            return redirect(route('pagos.index'));
        }

        return view('pagos.edit')->with('pago', $pago);
    }

    /**
     * Update the specified Pago in storage.
     *
     * @param int $id
     * @param UpdatePagoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePagoRequest $request)
    {
        $pago = $this->pagoRepository->find($id);

        if (empty($pago)) {
            Flash::error('Pago not found');

            return redirect(route('pagos.index'));
        }

        $pago = $this->pagoRepository->update($request->all(), $id);

        Flash::success('Pago updated successfully.');

        return redirect(route('pagos.index'));
    }

    /**
     * Remove the specified Pago from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pago = $this->pagoRepository->find($id);

        if (empty($pago)) {
            Flash::error('Pago not found');

            return redirect(route('pagos.index'));
        }

        $this->pagoRepository->delete($id);

        Flash::success('Pago deleted successfully.');

        return redirect(route('pagos.index'));
    }
}
