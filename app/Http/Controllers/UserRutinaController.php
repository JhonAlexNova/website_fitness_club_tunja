<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRutinaRequest;
use App\Http\Requests\UpdateUserRutinaRequest;
use App\Repositories\UserRutinaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class UserRutinaController extends AppBaseController
{
    /** @var UserRutinaRepository $userRutinaRepository*/
    private $userRutinaRepository;

    public function __construct(UserRutinaRepository $userRutinaRepo)
    {
        $this->userRutinaRepository = $userRutinaRepo;
    }

    /**
     * Display a listing of the UserRutina.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $userRutinas = $this->userRutinaRepository->all();

        return view('user_rutinas.index')
            ->with('userRutinas', $userRutinas);
    }

    /**
     * Show the form for creating a new UserRutina.
     *
     * @return Response
     */
    public function create()
    {
        return view('user_rutinas.create');
    }

    /**
     * Store a newly created UserRutina in storage.
     *
     * @param CreateUserRutinaRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRutinaRequest $request)
    {
        $input = $request->all();

        $userRutina = $this->userRutinaRepository->create($input);

        Flash::success('User Rutina saved successfully.');

        return redirect(route('userRutinas.index'));
    }

    /**
     * Display the specified UserRutina.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userRutina = $this->userRutinaRepository->find($id);

        if (empty($userRutina)) {
            Flash::error('User Rutina not found');

            return redirect(route('userRutinas.index'));
        }

        return view('user_rutinas.show')->with('userRutina', $userRutina);
    }

    /**
     * Show the form for editing the specified UserRutina.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userRutina = $this->userRutinaRepository->find($id);

        if (empty($userRutina)) {
            Flash::error('User Rutina not found');

            return redirect(route('userRutinas.index'));
        }

        return view('user_rutinas.edit')->with('userRutina', $userRutina);
    }

    /**
     * Update the specified UserRutina in storage.
     *
     * @param int $id
     * @param UpdateUserRutinaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRutinaRequest $request)
    {
        $userRutina = $this->userRutinaRepository->find($id);

        if (empty($userRutina)) {
            Flash::error('User Rutina not found');

            return redirect(route('userRutinas.index'));
        }

        $userRutina = $this->userRutinaRepository->update($request->all(), $id);

        Flash::success('User Rutina updated successfully.');

        return redirect(route('userRutinas.index'));
    }

    /**
     * Remove the specified UserRutina from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userRutina = $this->userRutinaRepository->find($id);

        if (empty($userRutina)) {
            Flash::error('User Rutina not found');

            return redirect(route('userRutinas.index'));
        }

        $this->userRutinaRepository->delete($id);

        Flash::success('User Rutina deleted successfully.');

        return redirect(route('userRutinas.index'));
    }
}
