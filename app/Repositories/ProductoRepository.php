<?php

namespace App\Repositories;

use App\Models\Producto;
use App\Repositories\BaseRepository;

/**
 * Class ProductoRepository
 * @package App\Repositories
 * @version August 13, 2023, 4:55 am UTC
*/

class ProductoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'icono',
        'categoria_id'
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


    public function withRelations($id=null)
    {
        $data = $this->model->with(['categoria','historial_precio','historial_producto',"portada","galeria"])->get();

        if(!is_null($id)){
            $data = $this->model->with(['categoria',"caracteristicas_producto",'historial_precio','historial_producto'])->where("id",$id)->get()->last();

        }
        return $data;
    }

    public function withRelationsFindUrl($url){
        $data = $this->model->with(['categoria',"caracteristicas_producto",'historial_precio','historial_producto'])
        ->where("url",$url)->get()->last();

        return $data;
    }


    public function byIdCategorias($categorias){
         $data = $this->model->with(['categoria','historial_precio','historial_producto',"portada","galeria"])
         ->whereIn("categoria_id",$categorias)
         ->get();
         return $data;
    }
}
