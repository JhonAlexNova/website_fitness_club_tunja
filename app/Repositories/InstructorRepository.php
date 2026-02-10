<?php

namespace App\Repositories;

use App\Models\Instructor;
use App\Repositories\BaseRepository;

/**
 * Class InstructorRepository
 * @package App\Repositories
 * @version October 26, 2024, 10:07 am -05
*/

class InstructorRepository extends BaseRepository
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
        return Instructor::class;
    }

    public function withRelations(){
        $empleados = Instructor::with('tipo_usuario')->whereHas('tipo_usuario',function($query){
            $query->where('rol_id', 3);
        })->get();

        return $empleados;
    }
}
