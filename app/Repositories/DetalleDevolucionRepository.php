<?php

namespace App\Repositories;

use App\Models\DetalleDevolucion;
use App\Repositories\BaseRepository;

/**
 * Class DetalleDevolucionRepository
 * @package App\Repositories
 * @version September 3, 2023, 8:01 am -05
*/

class DetalleDevolucionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'devolucion_id',
        'producto_id',
        'cantidad_unidades_devolucion',
        'valor_unit_de_cambio',
        'total_devuelto',
        'total_ganancia',
        'createt_at'
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
        return DetalleDevolucion::class;
    }
}
