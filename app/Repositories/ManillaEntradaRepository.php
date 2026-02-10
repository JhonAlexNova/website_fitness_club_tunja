<?php

namespace App\Repositories;

use App\Models\ManillaEntrada;
use App\Repositories\BaseRepository;

/**
 * Class ManillaEntradaRepository
 * @package App\Repositories
 * @version October 19, 2023, 4:24 pm -05
*/

class ManillaEntradaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'precio_full',
        'precio_reducido',
        'hora_corte'
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
        return ManillaEntrada::class;
    }

    public function withRelations(){
        return $this->model->with("stock_manilla")->get();
    }
}
