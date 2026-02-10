<?php

namespace App\Repositories;

use App\Models\AsistenciaEmpleado;
use App\Repositories\BaseRepository;

/**
 * Class AsistenciaEmpleadoRepository
 * @package App\Repositories
 * @version November 17, 2023, 10:00 pm -05
*/

class AsistenciaEmpleadoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'empleado_id'
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
        return AsistenciaEmpleado::class;
    }

    public function withRelations(){
        $data = $this->model->with('empleado')->get();
        return $data;
    }
}
