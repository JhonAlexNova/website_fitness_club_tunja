<?php

namespace App\Repositories;

use App\Models\RutinaEjercicio;
use App\Repositories\BaseRepository;

/**
 * Class RutinaEjercicioRepository
 * @package App\Repositories
 * @version February 9, 2025, 3:29 pm -05
*/

class RutinaEjercicioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_rutina',
        'id_ejercicio',
        'repeticiones',
        'series',
        'descanso_segundos'
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
        return RutinaEjercicio::class;
    }
}
