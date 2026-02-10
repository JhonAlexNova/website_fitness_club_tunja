<?php

namespace App\Repositories;

use App\Models\Chico;
use App\Repositories\BaseRepository;

use App\Models\Cierre;

/**
 * Class ChicoRepository
 * @package App\Repositories
 * @version August 21, 2023, 5:56 pm UTC
*/

class ChicoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'empleado_id',
        'cantidad',
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
        return Chico::class;
    }


    public function withRelations(){
        $cierre = Cierre::get()->last();

        // /dd($cierre);

        $data = [];

        if(is_null($cierre->fecha_fin)){
            $data =  $this->model->with('empleado')
            ->whereBetween('created_at',[$cierre->fecha_inicio, date('Y-m-d H:i:s')])
            ->orderBy('id','desc')->get();
        }


        return $data;
    }
}
