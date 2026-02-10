<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permiso;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permisos = Permiso::get();
        return $permisos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //VERIFICAR SI YA ESTA EL MODULO EN LA TABLA
        $permiso = Permiso::where('modulo_id',$request->modulo_id)
        ->where("roles_id",$request->rol_id)
        ->get()->last();
        if(is_null($permiso)){
           $permiso =  Permiso::create([
                'modulo_id' => $request->modulo_id,
                'roles_id' => $request->rol_id,
                'estado' => $request->estado
            ]);
        }else{
            $roles_selected = array();
            if($permiso->roles_id!=''){
                $roles_selected = explode(',',$permiso->roles_id);
            }
          //  return $roles_selected;
            if (!in_array($request->rol_id, $roles_selected)) {
                array_push($roles_selected, $request->rol_id);
            }

          // Verificar si $request->estado es igual a 0 y eliminar el rol si está presente
            if ($request->estado == 0) {
                $key = array_search($request->rol_id, $roles_selected);
                if ($key !== false) {
                    unset($roles_selected[$key]);
                }
            }

            $permiso->roles_id = implode(',',$roles_selected);
            $permiso->estado = $request->estado;
            $permiso->save();
            return response()->json(true);
        }
        
        return response()->json(["response"=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}