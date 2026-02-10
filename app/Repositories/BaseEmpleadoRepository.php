<?php

namespace App\Repositories;

use App\Models\BaseEmpleado;
use App\Repositories\BaseRepository;

/**
 * Class BaseEmpleadoRepository
 * @package App\Repositories
 * @version August 20, 2023, 3:29 pm UTC
*/

class BaseEmpleadoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'empleado_id',
        'valor'
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
        return BaseEmpleado::class;
    }


    public function withRelations(){
        return $this->model->with('empleado')->get();
    }
}
