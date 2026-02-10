<?php

namespace App\Repositories;

use App\Models\Punto;
use App\Repositories\BaseRepository;

/**
 * Class PuntoRepository
 * @package App\Repositories
 * @version May 11, 2025, 7:51 pm -05
*/

class PuntoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'tipo_punto',
        'descripcion',
        'puntos'
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
        return Punto::class;
    }
}
