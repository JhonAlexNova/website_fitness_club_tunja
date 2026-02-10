<?php

namespace App\Repositories;

use App\Models\Configuracion;
use App\Repositories\BaseRepository;

/**
 * Class ConfiguracionRepository
 * @package App\Repositories
 * @version August 13, 2023, 4:07 am UTC
*/

class ConfiguracionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'logo',
        'direccion',
        'telefono',
        'celular',
        'correo',
        'nit',
        'razon_social'
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
        return Configuracion::class;
    }
}
