<?php

namespace App\Repositories;

use App\Models\Pasadia;
use App\Repositories\BaseRepository;

/**
 * Class PasadiaRepository
 * @package App\Repositories
*/

class PasadiaRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nombre',
        'descripcion',
        'costo'
    ];

    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    public function model()
    {
        return Pasadia::class;
    }

    public function withRelations(){
        $data = $this->model->with('servicios')->get();
        return $data;
    }
}