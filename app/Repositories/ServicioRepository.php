<?php

namespace App\Repositories;

use App\Models\Servicio;
use App\Repositories\BaseRepository;

/**
 * Class ServicioRepository
 * @package App\Repositories
 * @version May 7, 2025, 2:44 pm -05
*/

class ServicioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
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
        return Servicio::class;
    }
}
