<?php

namespace App\Repositories;

use App\Models\HorarioClaseUnica;
use App\Repositories\BaseRepository;

/**
 * Class HorarioClaseUnicaRepository
 * @package App\Repositories
 * @version October 26, 2024, 10:19 am -05
*/

class HorarioClaseUnicaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'clase_id',
        'instructor_id',
        'fecha_hora',
        'cupo_maximo',
        'cupos_disponibles'
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
        return HorarioClaseUnica::class;
    }

    public function withRelations(){
        return $this->model->with(['clase','instructor'])->get();
    }
}
