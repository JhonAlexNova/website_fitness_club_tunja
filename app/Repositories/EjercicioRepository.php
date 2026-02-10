<?php

namespace App\Repositories;

use App\Models\Ejercicio;
use App\Repositories\BaseRepository;

/**
 * Class EjercicioRepository
 * @package App\Repositories
 * @version February 9, 2025, 2:10 pm -05
*/

class EjercicioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre_ejercicio',
        'musculo_objetivo',
        'equipo',
        'nivel_dificultad',
        'video_url'
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
        return Ejercicio::class;
    }


    public function withRelations(){
        $data = $this->model->get();
        return $data;
    }
}
