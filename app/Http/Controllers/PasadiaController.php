<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePasadiaRequest;
use App\Http\Requests\UpdatePasadiaRequest;
use App\Repositories\PasadiaRepository;
use App\Repositories\ServicioRepository;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\Pasadia;
use App\Models\Servicio;
use Storage;

class PasadiaController extends AppBaseController
{
    private $servicioRepository;
    private $pasadiaRepository;

    public function __construct(PasadiaRepository $pasadiaRepo, ServicioRepository $servicioRepo)
    {
        $this->servicioRepository = $servicioRepo;
        $this->pasadiaRepository = $pasadiaRepo;
    }

    public function index(Request $request)
    {
        $pasadias = $this->pasadiaRepository->all();

        return view('pasadias.index')
            ->with('pasadias', $pasadias);
    }

    public function create()
    {
        $servicios = $this->servicioRepository->all()->where('tipo', 'Pasadia');
        $backpack = [
            "servicios" => $servicios
        ];
        return view('pasadias.create', $backpack);
    }

    public function store(CreatePasadiaRequest $request)
    {
        $input = $request->all();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $path = Storage::disk('public')->putFile('pasadias', $file);
            $input['imagen'] = $path;
        }

        $pasadia = $this->pasadiaRepository->create($input);

        if ($request->has('servicios')) {
            $pasadia->servicios()->attach($request->input('servicios'));
        }

        Flash::success('Pasadía guardada exitosamente.');

        return redirect(route('pasadias.index'));
    }

    public function show($id)
    {
        $pasadia = $this->pasadiaRepository->find($id);

        if (empty($pasadia)) {
            Flash::error('Pasadía no encontrada');
            return redirect(route('pasadias.index'));
        }

        return view('pasadias.show')->with('pasadia', $pasadia);
    }

    public function edit($id)
    {
        $pasadia = Pasadia::findOrFail($id);
        $servicios = Servicio::where("tipo", "Pasadia")->get();
        $serviciosSeleccionados = $pasadia->servicios()->pluck('servicios.id')->toArray();

        return view('pasadias.edit', compact('pasadia', 'servicios', 'serviciosSeleccionados'));
    }

    public function update($id, UpdatePasadiaRequest $request)
    {
        $pasadia = Pasadia::findOrFail($id);
        $input = $request->all();

        if ($request->hasFile('imagen')) {
            if ($pasadia->imagen && Storage::disk('public')->exists($pasadia->imagen)) {
                Storage::disk('public')->delete($pasadia->imagen);
            }
            $file = $request->file('imagen');
            $path = Storage::disk('public')->putFile('pasadias', $file);
            $input['imagen'] = $path;
        }

        $pasadia->update($input);
        $pasadia->servicios()->sync($request->input('servicios', []));

        Flash::success('Pasadía actualizada correctamente.');

        return redirect(route('pasadias.index'));
    }

    public function destroy($id)
    {
        $pasadia = $this->pasadiaRepository->find($id);

        if (empty($pasadia)) {
            Flash::error('Pasadía no encontrada');
            return redirect(route('pasadias.index'));
        }

        $this->pasadiaRepository->delete($id);

        Flash::success('Pasadía eliminada exitosamente.');

        return redirect(route('pasadias.index'));
    }
}