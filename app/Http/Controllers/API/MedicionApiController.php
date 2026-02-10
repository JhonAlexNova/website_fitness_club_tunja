<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\CreateMedicionRequest;
use App\Http\Requests\UpdateMedicionRequest;
use App\Repositories\MedicionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class MedicionApiController extends AppBaseController
{
    /** @var MedicionRepository $medicionRepository*/
    private $medicionRepository;

    public function __construct(MedicionRepository $medicionRepo)
    {
        $this->medicionRepository = $medicionRepo;
    }

    /**
     * Display a listing of the Medicion.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $medicions = $this->medicionRepository->all()->where("user_id",request()->user()->id);

        return response()->json($medicions,200);
    }

    /**
     * Show the form for creating a new Medicion.
     *
     * @return Response
     */
    public function create()
    {
        return view('medicions.create');
    }

    /**
     * Store a newly created Medicion in storage.
     *
     * @param CreateMedicionRequest $request
     *
     * @return Response
     */
    //public function store(CreateMedicionRequest $request)
    public function store(Request $request)
    {
        $input = $request->all();
        $input["user_id"] = request()->user()->id;

        $medicion = $this->medicionRepository->create($input);

        return response()->json(["message"=>"Medición creada correctamente"],200);
    }

    /**
     * Display the specified Medicion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $medicion = $this->medicionRepository->find($id);

        if (empty($medicion)) {
            Flash::error('Medicion not found');

            return redirect(route('medicions.index'));
        }

        return view('medicions.show')->with('medicion', $medicion);
    }

    /**
     * Show the form for editing the specified Medicion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $medicion = $this->medicionRepository->find($id);

        if (empty($medicion)) {
            Flash::error('Medicion not found');

            return redirect(route('medicions.index'));
        }

        return view('medicions.edit')->with('medicion', $medicion);
    }

    /**
     * Update the specified Medicion in storage.
     *
     * @param int $id
     * @param UpdateMedicionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMedicionRequest $request)
    {
        $medicion = $this->medicionRepository->find($id);

        if (empty($medicion)) {
            Flash::error('Medicion not found');

            return redirect(route('medicions.index'));
        }

        $medicion = $this->medicionRepository->update($request->all(), $id);

        Flash::success('Medicion updated successfully.');

        return redirect(route('medicions.index'));
    }

    /**
     * Remove the specified Medicion from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $medicion = $this->medicionRepository->find($id);

        if (empty($medicion)) {
            Flash::error('Medicion not found');

            return redirect(route('medicions.index'));
        }

        $this->medicionRepository->delete($id);

        Flash::success('Medicion deleted successfully.');

        return redirect(route('medicions.index'));
    }
}
