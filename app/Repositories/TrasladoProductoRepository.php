<?php

namespace App\Repositories;

use App\Models\TrasladoProducto;
use App\Repositories\BaseRepository;

/**
 * Class TrasladoProductoRepository
 * @package App\Repositories
 * @version October 28, 2023, 8:25 pm -05
*/

class TrasladoProductoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'negocio_origen_id',
        'negocio_destino_id'
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
        return TrasladoProducto::class;
    }
}
