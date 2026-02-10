<?php

namespace App\Repositories;

use App\Models\ClaseRecurrente;
use App\Repositories\BaseRepository;

/**
 * Class ClaseRecurrenteRepository
 * @package App\Repositories
 * @version October 26, 2024, 10:20 am -05
*/

class ClaseRecurrenteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'clase_id',
        'instructor_id',
        'dia_semana',
        'hora',
        'duracion',
        'cupo_maximo'
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
        return ClaseRecurrente::class;
    }
}
