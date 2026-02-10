<?php

namespace App\Repositories;

use App\Models\Membresia;
use App\Repositories\BaseRepository;

/**
 * Class MembresiaRepository
 * @package App\Repositories
 * @version October 27, 2024, 6:02 pm -05
*/

class MembresiaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'descripcion',
        'costo',
        'duracion'
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
        return Membresia::class;
    }

    public function withRelations(){
        $data = $this->model->with('servicios')->get();
        return $data;
    }
}
