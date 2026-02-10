<?php

namespace App\Repositories;

use App\Models\ImagenProducto;
use App\Repositories\BaseRepository;

/**
 * Class ImagenProductoRepository
 * @package App\Repositories
 * @version November 3, 2024, 7:57 pm -05
*/

class ImagenProductoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'producto_id',
        'url',
        'es_portada'
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
        return ImagenProducto::class;
    }
}
