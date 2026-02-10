<?php

namespace App\Repositories;

use App\Models\Empleado;
use App\Repositories\BaseRepository;
use DB;
/**
 * Class EmpleadoRepository
 * @package App\Repositories
 * @version August 13, 2023, 4:40 am UTC
*/

class AdministradorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'foto_perfil',
        'username',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'celular',
        'estado',
        'email',
        'documento',
        'email_verified_at',
        'password',
        'remember_token'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Empleado::class;
    }

    public function withRelations(){
        $empleados = Empleado::with('tipo_usuario')->whereHas('tipo_usuario',function($query){
            $query->where('rol_id', 2);
        })->get();


        //dd($empleados);
        return $empleados;
    }
}
