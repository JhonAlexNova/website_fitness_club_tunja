<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEjercicioRequest;
use App\Http\Requests\UpdateEjercicioRequest;
use App\Repositories\EjercicioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Musculo;
use Flash;
use Response;
use Storage;

class EjercicioController extends AppBaseController
{
    /** @var EjercicioRepository $ejercicioRepository*/
    private $ejercicioRepository;

    public function __construct(EjercicioRepository $ejercicioRepo)
    {
        $this->ejercicioRepository = $ejercicioRepo;
    }

    /**
     * Display a listing of the Ejercicio.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $ejercicios = \App\Models\Ejercicio::with('musculos')->get();

        return view('ejercicios.index', compact('ejercicios'));
    }

    /**
     * Show the form for creating a new Ejercicio.
     *
     * @return Response
     */
    public function create()
    {
        $musculos = Musculo::all();

        return view('ejercicios.create', compact('musculos'));
    }

    /**
     * Store a newly created Ejercicio in storage.
     *
     * @param CreateEjercicioRequest $request
     *
     * @return Response
     */
    public function store(CreateEjercicioRequest $request)
    {
        $input = $request->all();

        if ($request->file('file_video')) {
            $input["video_url"] = Storage::disk('public')
                ->putFile('multimedia', $request->file('file_video'));
        }

        // Crear ejercicio
        $ejercicio = $this->ejercicioRepository->create($input);

        // Músculo principal
        if ($request->filled('musculo_principal')) {
            $ejercicio->musculos()->attach(
                $request->musculo_principal,
                ['es_principal' => true]
            );
        }

        // Músculos secundarios
        if ($request->has('musculos_secundarios')) {

            foreach ($request->musculos_secundarios as $musculoId) {

                // Evitar duplicar el principal
                if ($musculoId != $request->musculo_principal) {

                    $ejercicio->musculos()->attach(
                        $musculoId,
                        ['es_principal' => false]
                    );
                }
            }
        }

        Flash::success('Ejercicio saved successfully.');

        return redirect(route('ejercicios.index'));
    }
    /**
     * Display the specified Ejercicio.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ejercicio = $this->ejercicioRepository->find($id);

        if (empty($ejercicio)) {
            Flash::error('Ejercicio not found');

            return redirect(route('ejercicios.index'));
        }

        return view('ejercicios.show')->with('ejercicio', $ejercicio);
    }

    /**
     * Show the form for editing the specified Ejercicio.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ejercicio = $this->ejercicioRepository->find($id);
        $musculos = Musculo::all();

        if (empty($ejercicio)) {
            Flash::error('Ejercicio not found');
            return redirect(route('ejercicios.index'));
        }

        return view('ejercicios.edit', compact('ejercicio', 'musculos'));
    }

    /**
     * Update the specified Ejercicio in storage.
     *
     * @param int $id
     * @param UpdateEjercicioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEjercicioRequest $request)
{
    $input = $request->all();
    $ejercicio = $this->ejercicioRepository->find($id);

    if (empty($ejercicio)) {
        Flash::error('Ejercicio no encontrado');
        return redirect(route('ejercicios.index'));
    }

    try {
        // Manejo del archivo de video si se sube uno nuevo
        if ($request->hasFile('file_video')) {
            // Validar que sea un archivo de video
            $request->validate([
                'file_video' => 'mimetypes:video/avi,video/mp4,video/mpeg,video/quicktime,video/webm'
            ]);

            // Eliminar el video anterior si existe
            if ($ejercicio->video_url && Storage::disk('public')->exists($ejercicio->video_url)) {
                Storage::disk('public')->delete($ejercicio->video_url);
            }

            // Guardar el nuevo video
            $videoPath = $request->file('file_video')->store('multimedia', 'public');
            $input["video_url"] = $videoPath;
            
        }

        // Actualizar el ejercicio
        $ejercicio = $this->ejercicioRepository->update($input, $id);

        // 🔥 Actualizar músculos

        $ejercicio->musculos()->detach();

        // Músculo principal
        if ($request->filled('musculo_principal')) {
            $ejercicio->musculos()->attach(
                $request->musculo_principal,
                ['es_principal' => true]
            );
        }

        // Músculos secundarios
        if ($request->has('musculos_secundarios')) {

            foreach ($request->musculos_secundarios as $musculoId) {

                if ($musculoId != $request->musculo_principal) {

                    $ejercicio->musculos()->attach(
                        $musculoId,
                        ['es_principal' => false]
                    );
                }
            }
        }

        Flash::success('Ejercicio actualizado correctamente.');
        return redirect(route('ejercicios.index'));

    } catch (\Exception $e) {
        Flash::error('Error al actualizar el ejercicio: ' . $e->getMessage());
        return redirect()->back()->withInput();
    }
}

    /**
     * Remove the specified Ejercicio from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ejercicio = $this->ejercicioRepository->find($id);

        if (empty($ejercicio)) {
            Flash::error('Ejercicio not found');

            return redirect(route('ejercicios.index'));
        }

        $this->ejercicioRepository->delete($id);

        Flash::success('Ejercicio deleted successfully.');

        return redirect(route('ejercicios.index'));
    }
}
