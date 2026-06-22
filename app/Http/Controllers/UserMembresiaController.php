<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserMembresiaRequest;
use App\Http\Requests\UpdateUserMembresiaRequest;
use App\Repositories\UserMembresiaRepository;
use App\Repositories\ClienteRepository;
use App\Repositories\MembresiaRepository;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\User;

class UserMembresiaController extends AppBaseController
{
    /** @var UserMembresiaRepository $userMembresiaRepository*/
    private $userMembresiaRepository;
    private $clienteRepository;
    private $membresiaRepository;

    public function __construct(
        UserMembresiaRepository $userMembresiaRepo, 
        ClienteRepository $clienteRepo,
        ClienteRepository $ClienteRepo,
        MembresiaRepository $membresiaRepo
    )
    {
        $this->userMembresiaRepository = $userMembresiaRepo;
        $this->clienteRepository = $clienteRepo;
        $this->membresiaRepository = $membresiaRepo;
    }

    /**
     * Display a listing of the UserMembresia.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $userMembresias = $this->userMembresiaRepository->withRelations();

        return view('user_membresias.index')
            ->with('userMembresias', $userMembresias);
    }

    /**
     * Show the form for creating a new UserMembresia.
     *
     * @return Response
     */
    public function create()
    {
        $clientes = User::selectRaw("id, CONCAT_WS(' ', primer_nombre, segundo_nombre, primer_apellido, segundo_apellido) as nombre_completo")
            ->where("tipo", "Cliente")
            ->get()
            ->pluck('nombre_completo', 'id');

        $membresias = $this->membresiaRepository->withRelations()->pluck('nombre', 'id'); // ✅

        $backpack = [
            "clientes" => $clientes,
            "membresias" => $membresias
        ];

        return view('user_membresias.create', $backpack);
    }

    /**
     * Store a newly created UserMembresia in storage.
     *
     * @param CreateUserMembresiaRequest $request
     *
     * @return Response
     */
    public function store(CreateUserMembresiaRequest $request)
    {
        $input = $request->all();

        $userMembresia = $this->userMembresiaRepository->create($input);

        Flash::success('User Membresia saved successfully.');

        return redirect(route('userMembresias.index'));
    }

    /**
     * Display the specified UserMembresia.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userMembresia = $this->userMembresiaRepository->find($id);

        if (empty($userMembresia)) {
            Flash::error('User Membresia not found');

            return redirect(route('userMembresias.index'));
        }

        return view('user_membresias.show')->with('userMembresia', $userMembresia);
    }

    /**
     * Show the form for editing the specified UserMembresia.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userMembresia = $this->userMembresiaRepository->find($id);

        if (empty($userMembresia)) {
            Flash::error('User Membresia not found');
            return redirect(route('userMembresias.index'));
        }

        $clientes = User::selectRaw("id, CONCAT_WS(' ', primer_nombre, segundo_nombre, primer_apellido, segundo_apellido) as nombre_completo")
            ->where("tipo", "Cliente")
            ->get()
            ->pluck('nombre_completo', 'id');

        $membresias = $this->membresiaRepository->withRelations()->pluck('nombre', 'id'); // ✅

        $backpack = [
            "clientes" => $clientes,
            "membresias" => $membresias,
            "userMembresia" => $userMembresia
        ];

        return view('user_membresias.edit', $backpack);
    }

    /**
     * Update the specified UserMembresia in storage.
     *
     * @param int $id
     * @param UpdateUserMembresiaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserMembresiaRequest $request)
    {
        $userMembresia = $this->userMembresiaRepository->find($id);

        if (empty($userMembresia)) {
            Flash::error('User Membresia not found');

            return redirect(route('userMembresias.index'));
        }

        $userMembresia = $this->userMembresiaRepository->update($request->all(), $id);

        Flash::success('User Membresia updated successfully.');

        return redirect(route('userMembresias.index'));
    }

    /**
     * Remove the specified UserMembresia from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userMembresia = $this->userMembresiaRepository->find($id);

        if (empty($userMembresia)) {
            Flash::error('User Membresia not found');

            return redirect(route('userMembresias.index'));
        }

        $this->userMembresiaRepository->delete($id);

        Flash::success('User Membresia deleted successfully.');

        return redirect(route('userMembresias.index'));
    }
}