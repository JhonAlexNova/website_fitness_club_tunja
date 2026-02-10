<?php

namespace App\Repositories;

use App\Models\DetalleFactura;
use App\Repositories\BaseRepository;

/**
 * Class DetalleFacturaRepository
 * @package App\Repositories
 * @version August 21, 2023, 4:47 pm UTC
*/

class DetalleFacturaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'factura_id',
        'precio_id',
        'producto_id',
        'cantidad',
        'total'
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
        return DetalleFactura::class;
    }
}
