<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMembresiaRequest;
use App\Http\Requests\UpdateMembresiaRequest;
use App\Repositories\MembresiaRepository;
use App\Repositories\ServicioRepository;
use Illuminate\Support\Str;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\Membresia;
use App\Models\Servicio;
use Storage;

class MembresiaController extends AppBaseController
{
    
    
    private $servicioRepository;
    private $membresiaRepository;
    
    public function __construct(MembresiaRepository $membresiaRepo, ServicioRepository $servicioRepo)
    {
        $this->servicioRepository = $servicioRepo;
        $this->membresiaRepository = $membresiaRepo;
    }

    /**
     * Display a listing of the Membresia.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $membresias = $this->membresiaRepository->all();

        return view('membresias.index')
            ->with('membresias', $membresias);
    }

    /**
     * Show the form for creating a new Membresia.
     *
     * @return Response
     */
    public function create()
    {
        $servicios = $this->servicioRepository->all()->where('tipo', 'Membresia');
        $backpack = [
            "servicios" => $servicios
        ];
        return view('membresias.create',$backpack);
    }

    /**
     * Store a newly created Membresia in storage.
     *
     * @param CreateMembresiaRequest $request
     *
     * @return Response
     */
   public function store(CreateMembresiaRequest $request)
    {
        $input = $request->all();

        // Subir imagen si viene
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
           // $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            //$file->move(public_path('images/membresias'), $filename);
            $path = Storage::disk('public')->putFile('membresias', $file);
            $input['imagen'] = $path;
        }

        // Crear la membresía
        $membresia = $this->membresiaRepository->create($input);

        // Asociar servicios
        if ($request->has('servicios')) {
            $membresia->servicios()->attach($request->input('servicios'));
        }

        Flash::success('Membresía guardada exitosamente.');

        return redirect(route('membresias.index'));
    }

    /**
     * Display the specified Membresia.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $membresia = $this->membresiaRepository->find($id);

        if (empty($membresia)) {
            Flash::error('Membresia not found');

            return redirect(route('membresias.index'));
        }

        return view('membresias.show')->with('membresia', $membresia);
    }

    /**
     * Show the form for editing the specified Membresia.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        
        $membresia = Membresia::findOrFail($id);

            // Obtener todos los servicios
            $servicios = Servicio::where("tipo", "Membresia")->get();

            // IDs de los servicios que ya tiene esta membresía
            $serviciosSeleccionados = $membresia->servicios()->pluck('servicios.id')->toArray();

        return view('membresias.edit', compact('membresia', 'servicios', 'serviciosSeleccionados'));


    }

    /**
     * Update the specified Membresia in storage.
     *
     * @param int $id
     * @param UpdateMembresiaRequest $request
     *
     * @return Response
     */
   public function update($id, UpdateMembresiaRequest $request)
    {
        $membresia = Membresia::findOrFail($id);
        $input = $request->all();

        // Subir nueva imagen si viene
        if ($request->hasFile('imagen')) {

            // Borrar imagen anterior si existe
            if ($membresia->imagen && Storage::disk('public')->exists($membresia->imagen)) {
                Storage::disk('public')->delete($membresia->imagen);
            }

            $file = $request->file('imagen');
            $path = Storage::disk('public')->putFile('membresias', $file);
            $input['imagen'] = $path;
        }

        $membresia->update($input);

        // Actualizar servicios
        $membresia->servicios()->sync($request->input('servicios', []));

        Flash::success('Membresía actualizada correctamente.');

        return redirect(route('membresias.index'));
    }

    /**
     * Remove the specified Membresia from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $membresia = $this->membresiaRepository->find($id);

        if (empty($membresia)) {
            Flash::error('Membresia not found');

            return redirect(route('membresias.index'));
        }

        $this->membresiaRepository->delete($id);

        Flash::success('Membresia deleted successfully.');

        return redirect(route('membresias.index'));
    }
}
