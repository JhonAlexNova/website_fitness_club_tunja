<?php

namespace App\Repositories;

use App\Models\Cliente;
use App\Repositories\BaseRepository;

/**
 * Class ClienteRepository
 * @package App\Repositories
 * @version October 27, 2024, 8:30 am -05
*/

class ClienteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fecha_inscripcion',
        'talla',
        'correo',
        'perimetro_abdominal',
        'porcentaje_grasa',
        'porcentaje_musculo',
        'observaciones',
        'tipo',
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
        return Cliente::class;
    }


    public function withRelations(){
        return $this->model->get();
    }
}
