<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStockManillaRequest;
use App\Http\Requests\UpdateStockManillaRequest;
use App\Repositories\StockManillaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class StockManillaController extends AppBaseController
{
    /** @var StockManillaRepository $stockManillaRepository*/
    private $stockManillaRepository;

    public function __construct(StockManillaRepository $stockManillaRepo)
    {
        $this->stockManillaRepository = $stockManillaRepo;
    }

    /**
     * Display a listing of the StockManilla.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $stockManillas = $this->stockManillaRepository->all();

        return view('stock_manillas.index')
            ->with('stockManillas', $stockManillas);
    }

    /**
     * Show the form for creating a new StockManilla.
     *
     * @return Response
     */
    public function create()
    {
        return view('stock_manillas.create');
    }

    /**
     * Store a newly created StockManilla in storage.
     *
     * @param CreateStockManillaRequest $request
     *
     * @return Response
     */
    public function store(CreateStockManillaRequest $request)
    {
        $manilla_historial  = $this->stockManillaRepository->all()->where("manilla_id",$request->manilla_id)->last();
        if(is_null($manilla_historial)){
            $attributes = [
                "manilla_id" => $request->manilla_id,
                "cantidad_actual" => $request->cantidad,
                "cantidad_anterior"=>0,
                "cantidad" => $request->cantidad,
            ];

         
        }else{
            $cantidad_actual = $manilla_historial->cantidad_actual + $request->cantidad;

            $attributes = [
                "manilla_id" => $request->manilla_id,
                "cantidad_actual" => $cantidad_actual,
                "cantidad_anterior"=> $manilla_historial->cantidad_actual,
                "cantidad" => $request->cantidad,
            ];
        }

          $this->stockManillaRepository->create($attributes);

        //$attributes["manilla_id"] = $request->manilla_id;

        

        Flash::success('Stock Actualizado correctamente.');
        return response()->json(["response"=>true]);

    }

    /**
     * Display the specified StockManilla.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $stockManilla = $this->stockManillaRepository->find($id);

        if (empty($stockManilla)) {
            Flash::error('Stock Manilla not found');

            return redirect(route('stockManillas.index'));
        }

        return view('stock_manillas.show')->with('stockManilla', $stockManilla);
    }

    /**
     * Show the form for editing the specified StockManilla.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $stockManilla = $this->stockManillaRepository->find($id);

        if (empty($stockManilla)) {
            Flash::error('Stock Manilla not found');

            return redirect(route('stockManillas.index'));
        }

        return view('stock_manillas.edit')->with('stockManilla', $stockManilla);
    }

    /**
     * Update the specified StockManilla in storage.
     *
     * @param int $id
     * @param UpdateStockManillaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStockManillaRequest $request)
    {
        $stockManilla = $this->stockManillaRepository->find($id);

        if (empty($stockManilla)) {
            Flash::error('Stock Manilla not found');

            return redirect(route('stockManillas.index'));
        }

        $stockManilla = $this->stockManillaRepository->update($request->all(), $id);

        Flash::success('Stock Manilla updated successfully.');

        return redirect(route('stockManillas.index'));
    }

    /**
     * Remove the specified StockManilla from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $stockManilla = $this->stockManillaRepository->find($id);

        if (empty($stockManilla)) {
            Flash::error('Stock Manilla not found');

            return redirect(route('stockManillas.index'));
        }

        $this->stockManillaRepository->delete($id);

        Flash::success('Stock Manilla deleted successfully.');

        return redirect(route('stockManillas.index'));
    }
}
