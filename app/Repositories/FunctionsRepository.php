<?php

namespace App\Repositories;

use App\Models\Producto;
use App\Repositories\BaseRepository;

/**
 * Class QuizRepository
 * @package App\Repositories
 * @version March 5, 2024, 1:03 am UTC
*/

class FunctionsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
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
        return Producto::class;
    }

    public function set_url($string){
         // Convertir el texto a minúsculas
        $texto = strtolower($string);
        // Reemplazar espacios con guiones
        $texto = str_replace(' ', '-', $texto);
        // Eliminar caracteres especiales
        $texto = preg_replace('/[^a-z0-9\-]/', '', $texto);
        // Eliminar múltiples guiones consecutivos
        $texto = preg_replace('/-+/', '-', $texto);
        // Eliminar guiones al inicio y al final
        $texto = trim($texto, '-');
        return $texto;
    }

}
