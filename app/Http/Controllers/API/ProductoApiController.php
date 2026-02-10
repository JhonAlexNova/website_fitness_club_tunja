<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\ProductoRepository;

class ProductoApiController extends Controller
{
    private $productoRepository;

    public function __construct(
        ProductoRepository $productoRepo
    )
    {
        $this->productoRepository = $productoRepo;
    }

    public function get_productos_by_categorias(Request $request){/* array ids categorias */


        $categorias = $request->categorias;
        $productos = $this->productoRepository->byIdCategorias($categorias);
        
        return response()->json($productos,200);
    }
}
