<?php

namespace App\Repositories;

use App\Models\Categoria;
use App\Repositories\BaseRepository;

/**
 * Class CategoriaRepository
 * @package App\Repositories
 * @version August 13, 2023, 4:43 am UTC
*/

class CategoriaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'descripcion',
        'icono'
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
        return Categoria::class;
    }


    public function withRelations(){
        $categorias = Categoria::with('parent')->get();
        return $categorias;
    }

    public function withPrincipales(){
        $categorias = Categoria::whereNull('parent_id')->orderBy("nombre","ASC")->get();
        return $categorias;
    }

    public function subcategorias(){
        $subcategorias = Categoria::with('parent')
            ->whereNotNull('parent_id')
            ->get()
            ->mapWithKeys(function ($subcategoria) {
                // Concatenar el nombre del padre y el nombre de la subcategoría
                return [
                    $subcategoria->id => ($subcategoria->parent ? $subcategoria->parent->nombre . ' > ' : '') . $subcategoria->nombre
                ];
            });

        // Ya que necesitas tanto el ID como el nombre, no es necesario usar `array_values`
        // Simplemente puedes usar la colección directamente.
        $subcategorias = $subcategorias->toArray(); // Convertir a array
        $subcategorias = collect($subcategorias); // Convertir de nuevo a colección si es necesario


       // dd($subcategorias);

        return $subcategorias;
    }
}
