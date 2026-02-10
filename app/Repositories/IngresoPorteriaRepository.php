<?php

namespace App\Repositories;

use App\Models\IngresoPorteria;
use App\Repositories\BaseRepository;

/**
 * Class IngresoPorteriaRepository
 * @package App\Repositories
 * @version October 20, 2023, 12:53 pm -05
*/

class IngresoPorteriaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cliente_id',
        'manilla_id',
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
        return IngresoPorteria::class;
    }


    public function withRelations(){
        $data = $this->model->with('cliente')->get();
        return $data;
    }
}
