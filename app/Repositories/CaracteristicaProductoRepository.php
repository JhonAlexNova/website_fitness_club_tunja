<?php

namespace App\Repositories;

use App\Models\CaracteristicaProducto;
use App\Repositories\BaseRepository;

/**
 * Class CaracteristicaProductoRepository
 * @package App\Repositories
 * @version October 21, 2024, 3:32 pm -05
*/

class CaracteristicaProductoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'producto_id',
        'valor_caracteristica_id'
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
        return CaracteristicaProducto::class;
    }
}
