<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateConfiguracionRequest;
use App\Http\Requests\UpdateConfiguracionRequest;
use App\Repositories\ConfiguracionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Storage;
use DB;



use App\Models\TipoNegocio;
use App\Models\ModuloTipoNegocio;
use App\Models\ModuloApp;
use App\Models\Rol;


class ConfiguracionController extends AppBaseController
{
    /** @var ConfiguracionRepository $configuracionRepository*/
    private $configuracionRepository;

    public function __construct(ConfiguracionRepository $configuracionRepo)
    {
        $this->configuracionRepository = $configuracionRepo;
    }

    /**
     * Display a listing of the Configuracion.
     *
     * @param Request $request
     *
     * @return Response
     */

    public function estadoAcceso(Request $request){
        $configuracions = $this->configuracionRepository->find($request->config_id);
        $attr = [
            'acceso' => $request->estado
        ];
        $this->configuracionRepository->update($attr, $request->config_id);

        Flash::success('Acceso actualizado correctamete.');

        return redirect()->back();
    }

    public function index(Request $request)
    {
        $configuracions = $this->configuracionRepository->all();
        

        if(count($configuracions)>0){
            return redirect()->route('configuracions.edit',$configuracions->last()->id);
        }

        return redirect()->route('configuracions.create');
    }

    /**
     * Show the form for creating a new Configuracion.
     *
     * @return Response
     */
    public function create()
    {
        $configuracions = $this->configuracionRepository->all();

        if(count($configuracions)>0){
            return redirect()->route('configuracions.edit',$configuracions->last()->id);
        }
        
        return view('configuracions.create');
    }

    /**
     * Store a newly created Configuracion in storage.
     *
     * @param CreateConfiguracionRequest $request
     *
     * @return Response
     */
    public function store(CreateConfiguracionRequest $request)
    {
        $input = $request->all();

        if($request->file('file_logo')){
            $input['logo'] = Storage::disk('uploads')->putFile('logo',$request->file_logo);            
        }

        if($request->file('file_portada_login')){
            $input['portada_login'] = Storage::disk('uploads')->putFile('general',$request->file_portada_login);            
        }

        $configuracion = $this->configuracionRepository->create($input);

        Flash::success('Configuración creada correctamente.');

        return redirect(route('configuracions.edit',$configuracion->id));
    }

    /**
     * Display the specified Configuracion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $configuracion = $this->configuracionRepository->find($id);

        if (empty($configuracion)) {
            Flash::error('Configuracion not found');

            return redirect(route('configuracions.index'));
        }

        return view('configuracions.show')->with('configuracion', $configuracion);
    }

    /**
     * Show the form for editing the specified Configuracion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $configuracion = $this->configuracionRepository->find($id);

        $modulos_app = DB::table('modulos_tipo_negocio as mtn')
        ->join("modulos_app as mp","mp.id","mtn.modulo_id")
        ->select("mp.*")
        ->groupBy("mp.id")
        ->get();

        $all_modulos_app = DB::table("modulos_app")->get();
        $tipos_negocio = TipoNegocio::get();

        $rols = Rol::get();

        if (empty($configuracion)) {
            Flash::error('Configuracion not found');

            return redirect(route('configuracions.index'));
        }

        $backpack = [
            'configuracion' => $configuracion,
            'modulos_app' => $modulos_app,
            "tipos_negocio" => $tipos_negocio,
            "all_modulos_app" => $all_modulos_app,
            "rols" => $rols
        ];

        //dd($all_modulos_app);

        return view('configuracions.edit',$backpack);
    }

    /**
     * Update the specified Configuracion in storage.
     *
     * @param int $id
     * @param UpdateConfiguracionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConfiguracionRequest $request)
    {
        $configuracion = $this->configuracionRepository->find($id);

        //dd($request->all());
        
        if (empty($configuracion)) {
            Flash::error('Configuracion not found');

            return redirect(route('configuracions.index'));
        }

        if($request->file('file_logo')){
            $request['logo'] = Storage::disk('uploads')->putFile('logo',$request->file_logo);            
        }


        if($request->file('file_portada_login')){
            $request['portada_login'] = Storage::disk('uploads')->putFile('general',$request->file_portada_login);            
        }



        $configuracion = $this->configuracionRepository->update($request->all(), $id);
        Flash::success('Configuración actualizada correctamente.');


        return redirect()->back();
    }

    /**
     * Remove the specified Configuracion from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $configuracion = $this->configuracionRepository->find($id);

        if (empty($configuracion)) {
            Flash::error('Configuracion not found');

            return redirect(route('configuracions.index'));
        }

        $this->configuracionRepository->delete($id);

        Flash::success('Configuracion deleted successfully.');

        return redirect(route('configuracions.index'));
    }


    public function permisos_tipo_negocio(Request $request){
        $verificar = ModuloTipoNegocio::where("modulo_id",$request->modulo_id)->where("tipo_negocio_id",$request->tipo_negocio_id)->get()->last();
        if(is_null($verificar)){
            $modulos_tipo_negocio = ModuloTipoNegocio::create($request->all());
            return response()->json(['response'=>"Permiso agregado correctamente"]);
        }else{
            $verificar->delete();
            return response()->json(['response'=>"Permiso removido correctamente"]);
            
        }

    }

    public function get_permisos_tipo_negocio(Request $request){
        
        $modulos_tipo_negocio = ModuloApp::with('modulos_tipo_negocio')->get();
        return response()->json($modulos_tipo_negocio);
    }

    
}