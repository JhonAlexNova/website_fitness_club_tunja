<?php

namespace App\Repositories;

use App\Models\Devolucion;
use App\Repositories\BaseRepository;

/**
 * Class DevolucionRepository
 * @package App\Repositories
 * @version September 1, 2023, 8:34 pm -05
*/

class DevolucionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tipo',
        'fecha'
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
        return Devolucion::class;
    }

    public function withRelations(){
        $data = $this->model->with(['detalle_devolucion','detalle_devolucion.producto','detalle_devolucion.producto_cambio'])->orderBy('id','desc')->get();
        return $data;
    }
}
