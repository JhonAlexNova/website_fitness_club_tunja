<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGastoRequest;
use App\Http\Requests\UpdateGastoRequest;
use App\Repositories\GastoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Cierre;
use App\Models\Gasto;

use App\Repositories\CierreDiaRepository;

class GastoController extends AppBaseController
{
    /** @var GastoRepository $gastoRepository*/
    private $gastoRepository;
    private $cierreDiaRepository;

    public function __construct(
        GastoRepository $gastoRepo,
        CierreDiaRepository $cierreDiaRepo
    )
    {
        $this->gastoRepository = $gastoRepo;
        $this->cierreDiaRepository = $cierreDiaRepo;
    }

    /**
     * Display a listing of the Gasto.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->fecha_inicio){
            $fecha_inicio = $request->fecha_inicio;
            $fecha_fin = $request->fecha_fin;
        }else{
            $fecha_inicio = date('Y-m-d');
            $fecha_fin = date('Y-m-d');
        }


        $cierres_fechas = Cierre::orderBy('id','desc')->whereBetween('updated_at', [$fecha_inicio.' 00:00:00', $fecha_fin.' 23:59:59'])->get();


        $cierre_id = null;
        if($request->cierre_id){
           $cierre = Cierre::find($request->cierre_id);
           
        }else{
            $cierre = Cierre::get()->last();
            if(!is_null($cierre)){
                $cierre_id = $cierre->id;
            }
        }
 

        $gastos = [];

        if(empty($request->fecha_inicio) && !is_null($cierre) && is_null($cierre->fecha_fin)){
            $gastos = Gasto::where('cierre_id',$cierre->id)->get();
        }else if($request->fecha_inicio && $request->cierre_id){
            $gastos = Gasto::where('cierre_id',$cierre->id)->get();
        }else if($request->fecha_inicio && is_null($cierre->fecha_fin)){
            $gastos = Gasto::where('cierre_id',$cierre->id)->get();
        }else{

            if(!is_null($cierre)){
                $gastos = Gasto::where('cierre_id',$cierre->id)->get();
            }
        }

        $bakcpack = [
            'gastos' => $gastos,
            'fecha_inicio' => $fecha_inicio, 
            'fecha_fin' => $fecha_fin,
            'cierres_fechas' => $cierres_fechas,
            'cierre_id' => $cierre_id
        ];
        return view('gastos.index',$bakcpack);
    }

    /**
     * Show the form for creating a new Gasto.
     *
     * @return Response
     */
    public function create()
    {
        return view('gastos.create');
    }

    /**
     * Store a newly created Gasto in storage.
     *
     * @param CreateGastoRequest $request
     *
     * @return Response
     */
    public function store(CreateGastoRequest $request)
    {
        $cierre =  $this->cierreDiaRepository->validar_dia();
        $input = $request->all();
        $input['valor'] = str_replace(array(',','.'),'',$request->valor);
        $input['cierre_id'] = $cierre->id;

        $gasto = $this->gastoRepository->create($input);

        Flash::success('Gasto saved successfully.');

        return redirect(route('gastos.index'));
    }

    /**
     * Display the specified Gasto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $gasto = $this->gastoRepository->find($id);

        if (empty($gasto)) {
            Flash::error('Gasto not found');

            return redirect(route('gastos.index'));
        }

        return view('gastos.show')->with('gasto', $gasto);
    }

    /**
     * Show the form for editing the specified Gasto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $gasto = $this->gastoRepository->find($id);

        if (empty($gasto)) {
            Flash::error('Gasto not found');

            return redirect(route('gastos.index'));
        }



        return view('gastos.edit')->with('gasto', $gasto);
    }

    /**
     * Update the specified Gasto in storage.
     *
     * @param int $id
     * @param UpdateGastoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGastoRequest $request)
    {
        $gasto = $this->gastoRepository->find($id);

        if (empty($gasto)) {
            Flash::error('Gasto not found');

            return redirect(route('gastos.index'));
        }

        $request['valor'] = str_replace(array(',','.'),'',$request->valor);

        $gasto = $this->gastoRepository->update($request->all(), $id);

        Flash::success('Gasto updated successfully.');

        return redirect(route('gastos.index'));
    }

    /**
     * Remove the specified Gasto from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $gasto = $this->gastoRepository->find($id);

        if (empty($gasto)) {
            Flash::error('Gasto not found');

            return redirect(route('gastos.index'));
        }

        $this->gastoRepository->delete($id);

        Flash::success('Gasto deleted successfully.');

        return redirect(route('gastos.index'));
    }
}
