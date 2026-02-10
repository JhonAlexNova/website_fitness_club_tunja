<?php

namespace App\Repositories;

use App\Models\Cierre;
use App\Repositories\BaseRepository;

/**
 * Class ChicoRepository
 * @package App\Repositories
 * @version August 21, 2023, 5:56 pm UTC
*/

class CierreDiaRepository extends BaseRepository
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
        return Cierre::class;
    }

    public function validar_dia(){
        $cierre = Cierre::get()->last();
        if(is_null($cierre)){//no hay registros
           $cierre =  $this->abrir_dia();
        }else if(!is_null($cierre->fecha_fin)){//el dia esta cerrado
            $cierre = $this->abrir_dia();
        }
        return $cierre;
    }

    public function abrir_dia(){
        $cierre = Cierre::create([
            'fecha_inicio' => date('Y-m-d H:i:s')
        ]);

        return $cierre;
    }

    public function cerrar_dia(){
        $cierre = Cierre::get()->last();
        $cierre->fecha_fin = date('Y-m-d H:i:s');
        $cierre->save();

        return redirect()->back();
    }

}
