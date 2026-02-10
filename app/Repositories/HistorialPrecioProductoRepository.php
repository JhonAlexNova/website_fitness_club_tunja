<?php

namespace App\Repositories;

use App\Models\HistorialPrecioProducto;
use App\Repositories\BaseRepository;

/**
 * Class HistorialPrecioProductoRepository
 * @package App\Repositories
 * @version August 17, 2023, 2:54 am UTC
*/

class HistorialPrecioProductoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'producto_id',
        'precio',
        'fecha_actualizacion'
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
        return HistorialPrecioProducto::class;
    }
}
