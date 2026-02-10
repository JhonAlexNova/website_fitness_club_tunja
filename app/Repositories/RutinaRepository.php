<?php

namespace App\Repositories;

use App\Models\Rutina;
use App\Repositories\BaseRepository;

/**
 * Class RutinaRepository
 * @package App\Repositories
 * @version February 9, 2025, 2:31 pm -05
*/

class RutinaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre_rutina',
        'descripcion',
        'duracion_semanas',
        'user_id'
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
        return Rutina::class;
    }

    public function withRelations()
    {
        return $this->model
            ->with(["ejercicios_rutina",'ejercicios_rutina.ejercicio'])
            ->get();
    }
}
