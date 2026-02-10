<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRutinaRequest;
use App\Http\Requests\UpdateRutinaRequest;

use App\Repositories\RutinaRepository;
use App\Repositories\UserRepository;
use App\Repositories\EjercicioRepository;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;


class RutinaController extends AppBaseController
{
    private $rutinaRepository;
    private $userRepository;
    private $ejercicioRepository;

    public function __construct(
        RutinaRepository $rutinaRepo, 
        UserRepository $UserRepo,
        EjercicioRepository $ejercicioRepo
    )
    {
        $this->rutinaRepository = $rutinaRepo;
        $this->userRepository = $UserRepo;
        $this->ejercicioRepository = $ejercicioRepo;
    }


    public function index(Request $request)
    {
        $rutinas = $this->rutinaRepository->all();
       

        return view('rutinas.index')
            ->with('rutinas', $rutinas);
    }

    /**
     * Show the form for creating a new Rutina.
     *
     * @return Response
     */
    public function create()
    {
        $clientes = $this->userRepository->withRelations();

        $backpack = [
            "clientes" => $clientes
        ];
        return view('rutinas.create',$backpack);
    }

    /**
     * Store a newly created Rutina in storage.
     *
     * @param CreateRutinaRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $rutina = $this->rutinaRepository->create($input);

        Flash::success('Rutina creada correctamente, agrega ejercicios a la rutina');

        return redirect(route('admon.rutinas.edit', $rutina->id));
    }

    /**
     * Display the specified Rutina.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $rutina = $this->rutinaRepository->find($id);

        if (empty($rutina)) {
            Flash::error('Rutina not found');

            return redirect(route('rutinas.index'));
        }

        return view('rutinas.show')->with('rutina', $rutina);
    }

    /**
     * Show the form for editing the specified Rutina.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $rutina = $this->rutinaRepository->withRelations()->find($id);        

        $clientes = $this->userRepository->withRelations();
        $ejercicios = $this->ejercicioRepository->withRelations();
        


        $backpack = [
            "clientes" => $clientes,
            "rutina" => $rutina,
            "ejercicios" => $ejercicios
        ];

        if (empty($rutina)) {
            Flash::error('Rutina not found');

            return redirect(route('rutinas.index'));
        }

        return view('rutinas.edit',$backpack);
    }

    /**
     * Update the specified Rutina in storage.
     *
     * @param int $id
     * @param UpdateRutinaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRutinaRequest $request)
    {
        $rutina = $this->rutinaRepository->find($id);

        if (empty($rutina)) {
            Flash::error('Rutina not found');

            return redirect(route('rutinas.index'));
        }

        $rutina = $this->rutinaRepository->update($request->all(), $id);

        Flash::success('Rutina updated successfully.');

        return redirect(route('rutinas.index'));
    }

    /**
     * Remove the specified Rutina from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $rutina = $this->rutinaRepository->find($id);

        if (empty($rutina)) {
            Flash::error('Rutina not found');

            return redirect(route('rutinas.index'));
        }

        $this->rutinaRepository->delete($id);

        Flash::success('Rutina deleted successfully.');

        return redirect(route('rutinas.index'));
    }
}
